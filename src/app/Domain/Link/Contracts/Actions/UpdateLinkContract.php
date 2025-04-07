<?php

namespace App\Domain\Link\Contracts\Actions;

use App\Domain\Link\Models\Link;

interface UpdateLinkContract
{
    public function __invoke(int $id, array $data): Link;
}
