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
        string                 $message,
        ArrayAccess|Enumerable $data = null,
        int                    $http_status = Response::HTTP_OK,
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
        string                 $message,
        ArrayAccess|Enumerable $errors = null,
        int                    $http_status = Response::HTTP_BAD_REQUEST,
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
        bool                   $status,
        string                 $message,
        int                    $http_status,
        ArrayAccess|Enumerable $data = null,
        ArrayAccess|Enumerable $errors = null,
    ): JsonResponse
    {
        $this->data->put('status', $status);
        $this->data->put('message', $message);
        $this->data->put('data', $data);
        $this->data->put('error', $errors);

        return response()->json(
            $this->data,
            $http_status,
        );
    }
}
