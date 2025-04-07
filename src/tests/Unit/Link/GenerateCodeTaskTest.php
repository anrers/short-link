<?php

namespace Tests\Unit\Link;

use App\Domain\Link\Tasks\GenerateCodeTask;
use Tests\TestCase;

class GenerateCodeTaskTest extends TestCase
{
    private GenerateCodeTask $task;

    protected function setUp(): void
    {
        parent::setUp();
        $this->task = new GenerateCodeTask();
    }

    public function it_generates_code_with_correct_length()
    {
        config(['link.current_partition' => 'p']);

        $code = $this->task->__invoke();

        $this->assertEquals(7, strlen($code));
        $this->assertStringStartsWith('p', $code);
    }

    public function it_generates_code_with_only_allowed_characters()
    {
        config(['link.current_partition' => '']);

        $code = $this->task->__invoke();
        $allowedChars
            = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        for ($i = 0; $i < strlen($code); $i++) {
            $this->assertStringContainsString($code[$i], $allowedChars);
        }
    }

    public function it_includes_partition_in_generated_code()
    {
        $partition = 'a';
        config(['link.current_partition' => $partition]);

        $code = $this->task->__invoke();

        $this->assertStringStartsWith($partition, $code);
        $this->assertEquals(strlen($partition) + 6, strlen($code));
    }

    public function it_generates_different_codes_on_multiple_calls()
    {
        config(['link.current_partition' => '']);

        $codes = array_map(function () {
            return ($this->task)();
        }, range(1, 10));

        $this->assertCount(10, array_unique($codes));
    }

    public function it_handles_empty_partition_correctly()
    {
        config(['link.current_partition' => '']);

        $code = $this->task->__invoke();

        $this->assertEquals(6, strlen($code));
    }

    public function it_generates_code_with_correct_structure()
    {
        $partition = 'p';
        config(['link.current_partition' => $partition]);

        $code = $this->task->__invoke();

        $this->assertMatchesRegularExpression(
            '/^p[a-zA-Z0-9]{6}$/',
            $code,
            'Generated code does not match expected pattern'
        );
    }
}
