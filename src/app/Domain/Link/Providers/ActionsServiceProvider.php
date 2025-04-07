<?php

namespace App\Domain\Link\Providers;

use App\Domain\Link\Actions\CreateLinkAction;
use App\Domain\Link\Actions\DeleteLinkAction;
use App\Domain\Link\Actions\GetLinkByCodeAction;
use App\Domain\Link\Actions\GetLinkByIdAction;
use App\Domain\Link\Actions\GetLinksByUserIdAction;
use App\Domain\Link\Actions\UpdateLinkAction;
use App\Domain\Link\Contracts\Actions\CreateLinkContract;
use App\Domain\Link\Contracts\Actions\DeleteLinkContract;
use App\Domain\Link\Contracts\Actions\GetLinkByCodeContract;
use App\Domain\Link\Contracts\Actions\GetLinkByIdContract;
use App\Domain\Link\Contracts\Actions\GetLinksByUserIdContract;
use App\Domain\Link\Contracts\Actions\UpdateLinkContract;
use Illuminate\Support\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public $bindings
        = [
            CreateLinkContract::class => CreateLinkAction::class,
            GetLinkByCodeContract::class => GetLinkByCodeAction::class,
            UpdateLinkContract::class       => UpdateLinkAction::class,
            DeleteLinkContract::class       => DeleteLinkAction::class,
            GetLinksByUserIdContract::class => GetLinksByUserIdAction::class,
            GetLinkByIdContract::class      => GetLinkByIdAction::class,
        ];

    public function register(): void
    {
        $this->registerBindings();
    }

    protected function registerBindings(): void
    {
    }
}
