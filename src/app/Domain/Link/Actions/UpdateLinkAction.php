<?php

namespace App\Domain\Link\Actions;

use App\Domain\Link\Contracts\Actions\UpdateLinkContract;
use App\Domain\Link\Contracts\Repositories\LinkRepositoryContract;
use App\Domain\Link\Models\Link;

class UpdateLinkAction implements UpdateLinkContract
{
    public function __construct(
        protected LinkRepositoryContract $linkRepository
    ) {
    }

    public function __invoke(int $id, array $data): Link
    {
        return $this->linkRepository->update($id, $data);
    }
}
