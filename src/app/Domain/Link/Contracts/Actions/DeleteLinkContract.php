<?php

namespace App\Domain\Link\Contracts\Actions;

interface DeleteLinkContract
{
    public function __invoke(int $id): bool;
}
