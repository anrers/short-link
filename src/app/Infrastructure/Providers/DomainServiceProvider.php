<?php

namespace App\Infrastructure\Providers;

use App\Domain\Auth\Providers\AuthServiceProvider;
use App\Domain\Link\Providers\LinkServiceProvider;
use App\Infrastructure\Abstracts\Providers\BaseServiceProvider;

class DomainServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(LinkServiceProvider::class);
    }
}
