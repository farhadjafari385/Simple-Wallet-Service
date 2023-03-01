<?php

namespace App\Services\StandardResponse;

use ArrayAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;
use Symfony\Component\HttpFoundation\Response;

class StandardResponseService
{
    public function __construct(private readonly Collection $data)
    {
    }

    public function success(
        string                            $message,
        ArrayAccess|Enumerable|array|null $data = null,
        int                               $http_status = Response::HTTP_OK,
    ): JsonResponse
    {
        return $this->response(
            true,
            $message,
            $http_status,
            $data,
        );
    }

    public function failed(
        string                            $message,
        ArrayAccess|Enumerable|array|null $errors = null,
        int                               $http_status = Response::HTTP_BAD_REQUEST,
    ): JsonResponse
    {
        return $this->response(
            false,
            $message,
            $http_status,
            errors: $errors,
        );
    }

    public function response(
        bool                              $status,
        string                            $message,
        int                               $http_status,
        ArrayAccess|Enumerable|array|null $data = null,
        ArrayAccess|Enumerable|array|null $errors = null,
    ): JsonResponse
    {
        $this->data
            ->put('status', $status)
            ->put('message', $message)
            ->put('data', $data)
            ->put('error', $errors);

        return response()->json(
            $this->data,
            $http_status,
        );
    }
}
