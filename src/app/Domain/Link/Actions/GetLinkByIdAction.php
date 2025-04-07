<?php

namespace App\Domain\Link\Actions;

use App\Domain\Link\Contracts\Actions\GetLinkByIdContract;
use App\Domain\Link\Models\Link;
use App\Domain\Link\Repositories\LinkRepository;

class GetLinkByIdAction implements GetLinkByIdContract
{
    public function __construct(
        protected LinkRepository $linkRepository
    ) {
    }

    public function __invoke(int $id): Link
    {
        return $this->linkRepository
            ->getModelObject()
            ->findOrFail($id);
    }
}
