<?php

namespace App\Domain\Link\Contracts\Actions;

use Illuminate\Database\Eloquent\Collection;

interface GetLinksByUserIdContract
{
    public function __invoke(int $id): Collection;
}
