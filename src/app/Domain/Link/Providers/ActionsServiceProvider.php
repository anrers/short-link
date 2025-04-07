<?php

namespace App\Domain\Link\Providers;

use Illuminate\Support\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public $bindings
        = [
        ];

    public function register(): void
    {
        $this->registerBindings();
    }

    protected function registerBindings(): void
    {
    }
}
