<?php

namespace App\Domain\Link\Contracts\Repositories;

use App\Domain\Link\Models\Link;
use App\Infrastructure\Abstracts\Repositories\BaseRepository;
use App\Infrastructure\Contracts\ModelRepositoryContract;

/**
 * @extends BaseRepository<Link>
 */
interface LinkRepositoryContract extends ModelRepositoryContract
{
}
