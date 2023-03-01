<?php

namespace App\Services\StandardResponse\Provider;

use ArrayAccess;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Enumerable;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response;
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
        $response->macro('success', function (
            string                 $message,
            ArrayAccess|Enumerable $data = null,
            int                    $http_status = Response::HTTP_OK,
        ) {
            return resolve(StandardResponseService::class)->sucess(
                $message,
                $data,
                $http_status,
            );
        });
        $response->macro('failed', function (
            string                 $message,
            ArrayAccess|Enumerable $errors = null,
            int                    $http_status = Response::HTTP_BAD_REQUEST,
        ) {
            return resolve(StandardResponseService::class)->failed(
                $message,
                $errors,
                $http_status
            );
        });
    }
}
