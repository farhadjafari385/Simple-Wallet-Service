<?php

namespace App\Services\StandardResponse\Provider;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use App\Services\StandardResponse\StandardResponseService;
use Symfony\Component\HttpFoundation\Response;

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
            $message,
            $data = null,
            $http_status = Response::HTTP_OK,
        ) {
            return resolve(StandardResponseService::class)
                ->success(
                    $message,
                    $data,
                    $http_status
                );
        });

        $response->macro('failed', function (
            $message,
            $errors = null,
            $http_status = Response::HTTP_BAD_REQUEST
        ) {
            return resolve(StandardResponseService::class)
                ->failed(
                    $message,
                    $errors,
                    $http_status
                );
        });
    }
}
