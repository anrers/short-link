<?php

namespace App\Domain\Link\Contracts\Actions;

use App\Domain\Link\Models\Link;

interface GetLinkByIdContract
{
    public function __invoke(int $id): Link;
}
