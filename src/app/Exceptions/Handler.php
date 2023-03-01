<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    public function render($request, Throwable $e)
    {
        return response()->failed(
            $e->getMessage(),
            $this->errors($e),
            $this->code($e),
        );
    }

    private function code(Throwable $e): int
    {
        return match (true) {
            ($e->getCode() < 100 || $e->getCode() >= 600) => 500,
            default => $e->getCode(),
        };
    }

    private function errors($e): array
    {
        $errors = [];

        if (app()->hasDebugModeEnabled()) {
            $errors['debug'] = [
                'file' => $e->getFile() . ':' . $e->getLine(),
                'trace' => $e->getTrace(),
            ];
        }

        return $errors;
    }
}
