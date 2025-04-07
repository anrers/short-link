<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\Contracts\Actions\SignOutContract;
use Illuminate\Support\Facades\Auth;

class SignOutAction implements SignOutContract
{
    public function __invoke(): void
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();
    }
}
