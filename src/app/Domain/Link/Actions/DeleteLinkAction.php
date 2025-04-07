<?php

namespace App\Domain\Link\Actions;

use App\Domain\Link\Contracts\Actions\DeleteLinkContract;
use App\Domain\Link\Repositories\LinkRepository;

class DeleteLinkAction implements DeleteLinkContract
{
    public function __construct(
        protected LinkRepository $linkRepository
    ) {
    }

    public function __invoke(int $id): bool
    {
        return $this->linkRepository->delete($id);
    }
}
