<?php

namespace App\Services\StandardResponse\Contracts;

use ArrayAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Enumerable;
use Symfony\Component\HttpFoundation\Response;

interface StandardResponseServiceInterface
{
    /**
     *  Success Response
     *
     * @param string $message
     * @param ArrayAccess|Enumerable|array|null $data
     * @param int $http_status
     * @return JsonResponse
     */
    public function success(
        string                            $message,
        ArrayAccess|Enumerable|array|null $data = null,
        int                               $http_status = Response::HTTP_OK,
    ): JsonResponse;

    /**
     *
     * Failed Response
     *
     * @param string $message
     * @param ArrayAccess|Enumerable|array|null $errors
     * @param int $http_status
     * @return JsonResponse
     */
    public function failed(
        string                            $message,
        ArrayAccess|Enumerable|array|null $errors = null,
        int                               $http_status = Response::HTTP_BAD_REQUEST,
    ): JsonResponse;
}
