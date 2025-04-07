<?php

namespace App\Domain\Link\Providers;

use App\Domain\Link\Repositories\LinkRepository;
use App\Infrastructure\Abstracts\Providers\BaseServiceProvider;

class LinkServiceProvider extends BaseServiceProvider
{
    public $bindings
        = [
            LinkRepository::class => LinkRepository::class,
        ];

    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );
    }
}
