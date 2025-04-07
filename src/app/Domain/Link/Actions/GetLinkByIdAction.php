<?php

namespace App\Domain\Link\Actions;

use App\Domain\Link\Contracts\Actions\GetLinkByIdContract;
use App\Domain\Link\Contracts\Repositories\LinkRepositoryContract;
use App\Domain\Link\Models\Link;

class GetLinkByIdAction implements GetLinkByIdContract
{
    public function __construct(
        protected LinkRepositoryContract $linkRepository
    ) {
    }

    public function __invoke(int $id): Link
    {
        return $this->linkRepository
            ->getModelObject()
            ->findOrFail($id);
    }
}
