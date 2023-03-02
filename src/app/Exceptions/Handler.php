<?php

namespace App\Exceptions;

use App\Exceptions\Contracts\BaseException;
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
        return failed(
            $this->message($e),
            $this->errors($e),
            $this->code($e),
        );
    }

    private function message(Throwable $e): string
    {
        $message = 'Something went wrong.';

        if ($e instanceof \Exception) {
            $message = $e->getMessage();
        }
        else if (app()->hasDebugModeEnabled()) {
            $message = $e->getMessage();
        }

        return $message;
    }

    private function code(Throwable $e): int
    {
        $code = (int)$e->getCode();

        return match (true) {
            ($code < 100 || $code >= 600) => 500,
            default => $code,
        };
    }

    private function errors($e): array
    {
        $errors = collect();

        if ($e instanceof BaseException) {
            $errors->push(
                $e->errors()
            );
        }

        if (app()->hasDebugModeEnabled()) {
            $errors = $errors->merge([
                'debug' => [
                    'file' => $e->getFile() . ':' . $e->getLine(),
                    'trace' => $e->getTrace(),
                ]
            ]);
        }

        return $errors->toArray();
    }
}
