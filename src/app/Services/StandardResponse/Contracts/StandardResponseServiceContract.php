<?php

namespace App\Services\StandardResponse\Contracts;

use ArrayAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;

abstract class StandardResponseServiceContract implements StandardResponseServiceInterface
{
    /**
     * @param Collection $data
     */
    public function __construct(private readonly Collection $data)
    {
    }

    /**
     *
     * Response Generator
     *
     * @param bool $status
     * @param string $message
     * @param int $http_status
     * @param ArrayAccess|Enumerable|array|null $data
     * @param ArrayAccess|Enumerable|array|null $errors
     * @return JsonResponse
     */
    protected function response(
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
            $this->data->toArray(),
            $http_status,
        );
    }
}
