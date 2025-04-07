<?php

namespace Tests\Feature\Link;

use App\Domain\Link\Actions\CreateLinkAction;
use App\Domain\Link\Contracts\Repositories\LinkRepositoryContract;
use App\Domain\Link\Models\Link;
use App\Domain\Link\Tasks\GenerateCodeTask;
use App\Domain\User\Models\User;
use Exception;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Mockery;
use Tests\TestCase;

class CreateLinkActionTest extends TestCase
{
    use RefreshDatabase;

    protected LinkRepositoryContract $linkRepository;
    protected GenerateCodeTask $codeTask;
    protected CreateLinkAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        $this->linkRepository = Mockery::mock(LinkRepositoryContract::class);
        $this->codeTask = Mockery::mock(GenerateCodeTask::class);
        $this->action = new CreateLinkAction(
            $this->linkRepository,
            $this->codeTask
        );
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function it_creates_link_successfully_with_all_fields()
    {
        $user = User::factory()->create();
        $testData = [
            'name'     => 'Test Link',
            'original' => 'https://example.com',
            'user_id'  => $user->id,
        ];

        $generatedCode = 'abc123';
        $partition = 'default';

        config(['link.current_partition' => $partition]);

        $expectedData = $testData + [
                'code'      => $generatedCode,
                'partition' => $partition,
            ];

        $link = Link::factory()->make($expectedData);

        $this->codeTask->shouldReceive('__invoke')
            ->once()
            ->andReturn($generatedCode);

        $this->linkRepository->shouldReceive('create')
            ->once()
            ->with($expectedData)
            ->andReturn($link);

        $result = $this->action->__invoke($testData);

        $this->assertInstanceOf(Link::class, $result);
        $this->assertEquals($generatedCode, $result->code);
        $this->assertEquals($partition, $result->partition);
        $this->assertEquals($testData['name'], $result->name);
        $this->assertEquals($testData['original'], $result->original);
        $this->assertEquals($testData['user_id'], $result->user_id);
    }

    public function it_retries_on_code_collision()
    {
        $user = User::factory()->create();
        $testData = [
            'original' => 'https://example.com',
            'name'     => 'Collision Test',
            'user_id'  => $user->id,
        ];

        $firstCode = 'collision123';
        $secondCode = 'valid456';
        $partition = 'default';

        config(['link.current_partition' => $partition]);

        $this->codeTask->shouldReceive('__invoke')
            ->twice()
            ->andReturn($firstCode, $secondCode);

        $this->linkRepository->shouldReceive('create')
            ->once()
            ->with([
                'original'  => $testData['original'],
                'name'      => $testData['name'],
                'code'      => $firstCode,
                'partition' => $partition,
                'user_id'   => $user->id,
            ])
            ->andThrow(
                new UniqueConstraintViolationException(
                    'test',
                    'test',
                    [],
                    new Exception()
                )
            );

        $this->linkRepository->shouldReceive('create')
            ->with([
                'original'  => $testData['original'],
                'name'      => $testData['name'],
                'code'      => $secondCode,
                'partition' => $partition,
                'user_id'   => $user->id,
            ])
            ->andReturn(
                Link::factory()->make([
                    'original'  => $testData['original'],
                    'name'      => $testData['name'],
                    'partition' => $partition,
                    'user_id'   => $testData['user_id'],
                    'code'      => $secondCode,
                ])
            );

        $result = $this->action->__invoke($testData);

        $this->assertEquals($secondCode, $result->code);
    }

    public function it_throws_exception_after_max_attempts()
    {
        $testData = ['original' => 'https://example.com'];
        $partition = 'default';

        config(['link.current_partition' => $partition]);

        $this->codeTask->shouldReceive('__invoke')
            ->times(6)
            ->andReturn('code123');

        $this->linkRepository->shouldReceive('create')
            ->times(6)
            ->with(
                Mockery::on(function ($data) use ($partition) {
                    return $data['original'] === 'https://example.com'
                        && $data['partition'] === $partition
                        && $data['code'] === 'code123';
                })
            )
            ->andThrow(
                new UniqueConstraintViolationException(
                    'test',
                    'test',
                    [],
                    new Exception()
                )
            );

        Log::shouldReceive('error')
            ->times(6)
            ->with(
                "Generate key collision",
                Mockery::on(function ($arg) {
                    return is_array($arg) && isset($arg['attempt'])
                        && isset($arg['type']);
                })
            );

        $this->expectException(UniqueConstraintViolationException::class);

        $this->action->__invoke($testData);
    }
}
