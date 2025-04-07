<?php

namespace App\Domain\Auth\Actions;

use App\Domain\Auth\Contracts\Actions\SignInContract;
use Illuminate\Support\Facades\Auth;

class SignInAction implements SignInContract
{
    public function __invoke(array $credentials): bool
    {
        if (Auth::attempt($credentials)) {
            session()->regenerate();
            return true;
        }

        return false;
    }
}
