<?php

use App\Infrastructure\Providers\AppServiceProvider;
use App\Infrastructure\Providers\DomainServiceProvider;
use App\Infrastructure\Providers\SwaggerUiServiceProvider;

return [
    AppServiceProvider::class,
    DomainServiceProvider::class,
    SwaggerUiServiceProvider::class,
];
