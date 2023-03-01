<?php

namespace App\Services\StandardResponse\Provider;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use App\Services\StandardResponse\StandardResponseService;

class StandardResponseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(StandardResponseService::class, function () {
            return new StandardResponseService(
                collect()
            );
        });
    }

    public function boot(ResponseFactory $response): void
    {
        $response->macro('success', function (mixed ...$value) {
            return resolve(StandardResponseService::class)->sucess($value);
        });
        $response->macro('failed', function (mixed ...$value) {
            return resolve(StandardResponseService::class)->failed(...$value);
        });
    }
}
