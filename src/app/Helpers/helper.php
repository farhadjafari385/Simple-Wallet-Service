<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Enumerable;
use Symfony\Component\HttpFoundation\Response;

if (!function_exists('success')) {
    function success(
        string                            $message,
        ArrayAccess|Enumerable|array|null $data = null,
        int                               $http_status = Response::HTTP_OK,
    ): JsonResponse
    {
        return response()->success(
            $message,
            $data,
            $http_status
        );
    }
}

if (!function_exists('failed')) {
    function failed(
        string                            $message,
        ArrayAccess|Enumerable|array|null $errors = null,
        int                               $http_status = Response::HTTP_BAD_REQUEST,
    ): JsonResponse
    {
        return response()->failed(
            $message,
            $errors,
            $http_status
        );
    }
}
