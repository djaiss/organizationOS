<?php

declare(strict_types=1);

use EragLaravelDisposableEmail\LaravelDisposableEmailServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    LaravelDisposableEmailServiceProvider::class,
];
