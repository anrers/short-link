<?php

namespace App\Domain\Link\Contracts\Actions;

use App\Domain\Link\Models\Link;

interface GetLinkByCodeContract
{
    public function __invoke(string $code): Link;
}
