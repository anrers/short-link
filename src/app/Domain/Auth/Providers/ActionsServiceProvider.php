<?php

declare(strict_types=1);

namespace App\Domain\Auth\Providers;

use App\Domain\Auth\Actions\SignInAction;
use App\Domain\Auth\Actions\SignOutAction;
use App\Domain\Auth\Contracts\Actions\SignInContract;
use App\Domain\Auth\Contracts\Actions\SignOutContract;
use Illuminate\Support\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public $bindings
        = [
            SignInContract::class  => SignInAction::class,
            SignOutContract::class => SignOutAction::class,
        ];

    public function register(): void
    {
        $this->registerBindings();
    }

    protected function registerBindings(): void
    {
    }
}
