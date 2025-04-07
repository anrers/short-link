<?php

namespace App\Domain\Auth\Contracts\Actions;

interface SignOutContract
{
    public function __invoke(): void;
}
