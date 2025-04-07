<?php

namespace App\Infrastructure\Providers;

use App\Domain\Auth\Providers\AuthServiceProvider;
use App\Infrastructure\Abstracts\Providers\BaseServiceProvider;

class DomainServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->app->register(AuthServiceProvider::class);
    }
}
