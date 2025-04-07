<?php

namespace App\Domain\Auth\Contracts\Actions;

interface SignInContract
{
    public function __invoke(array $credentials): bool;
}
