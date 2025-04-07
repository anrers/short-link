<?php

namespace App\Domain\Link\Contracts\Actions;

use App\Domain\Link\Models\Link;

interface CreateLinkContract
{
    public function __invoke(array $data): Link;
}
