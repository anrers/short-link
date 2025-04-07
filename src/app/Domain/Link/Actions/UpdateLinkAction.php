<?php

namespace App\Domain\Link\Actions;

use App\Domain\Link\Contracts\Actions\CreateLinkContract;
use App\Domain\Link\Contracts\Actions\UpdateLinkContract;
use App\Domain\Link\Models\Link;
use App\Domain\Link\Repositories\LinkRepository;
use App\Domain\Link\Tasks\GenerateCodeTask;
use Illuminate\Database\UniqueConstraintViolationException;
use Log;

class UpdateLinkAction implements UpdateLinkContract
{
    public function __construct(
        protected LinkRepository $linkRepository
    ) {
    }

    public function __invoke(int $id, array $data): Link
    {
        return $this->linkRepository->update($id, $data);
    }
}
