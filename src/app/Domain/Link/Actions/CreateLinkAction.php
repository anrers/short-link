<?php

namespace App\Domain\Link\Actions;

use App\Domain\Link\Contracts\Actions\CreateLinkContract;
use App\Domain\Link\Contracts\Repositories\LinkRepositoryContract;
use App\Domain\Link\Models\Link;
use App\Domain\Link\Tasks\GenerateCodeTask;
use Illuminate\Database\UniqueConstraintViolationException;
use Log;

class CreateLinkAction implements CreateLinkContract
{
    protected int $maxAttempts = 5;

    public function __construct(
        protected LinkRepositoryContract $linkRepository,
        protected GenerateCodeTask $codeTask
    ) {
    }

    public function __invoke(array $data): Link
    {
        for ($attempt = 0; $attempt <= $this->maxAttempts; $attempt++) {
            try {
                $data['code'] = $this->codeTask->__invoke();
                $data['partition'] = config('link.current_partition');
                $link = $this->linkRepository->create($data);
                break;
            } catch (UniqueConstraintViolationException $e) {
                Log::error(
                    "Generate key collision",
                    ['attempt' => $attempt, 'type' => 'collision']
                );
                if ($attempt == $this->maxAttempts) {
                    throw $e;
                }
            }
        }

        return $link;
    }
}
