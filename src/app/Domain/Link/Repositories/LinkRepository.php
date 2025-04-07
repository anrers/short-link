<?php

namespace App\Domain\Link\Repositories;

use App\Domain\Link\Contracts\Repositories\LinkRepositoryContract;
use App\Domain\Link\Models\Link;
use App\Infrastructure\Abstracts\Repositories\BaseRepository;

/**
 * @extends BaseRepository<Link>
 */
class LinkRepository extends BaseRepository implements LinkRepositoryContract
{
    public function getModelClass(): string
    {
        return Link::class;
    }
}
