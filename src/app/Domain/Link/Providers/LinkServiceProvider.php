<?php

namespace App\Domain\Link\Providers;

use App\Infrastructure\Abstracts\Providers\BaseServiceProvider;

class LinkServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->app->register(
            ActionsServiceProvider::class
        );
    }
}
