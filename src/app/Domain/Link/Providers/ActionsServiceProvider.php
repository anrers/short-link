<?php

namespace App\Domain\Link\Providers;

use App\Domain\Link\Actions\CreateLinkAction;
use App\Domain\Link\Contracts\Actions\CreateLinkContract;
use Illuminate\Support\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public $bindings
        = [
            CreateLinkContract::class => CreateLinkAction::class,
        ];

    public function register(): void
    {
        $this->registerBindings();
    }

    protected function registerBindings(): void
    {
    }
}
