<?php

namespace App\Domain\Link\Actions;

use App\Domain\Link\Contracts\Actions\GetLinksByUserIdContract;
use App\Domain\Link\Repositories\LinkRepository;
use Illuminate\Database\Eloquent\Collection;

class GetLinksByUserIdAction implements GetLinksByUserIdContract
{
    public function __construct(
        protected LinkRepository $linkRepository
    ) {
    }

    public function __invoke(int $id): Collection
    {
        return $this->linkRepository
            ->getModelObject()
            ->where('user_id', $id)
            ->get();
    }
}
