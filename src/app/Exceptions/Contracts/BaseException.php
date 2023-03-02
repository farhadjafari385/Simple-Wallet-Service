<?php

namespace App\Exceptions\Contracts;

use Exception;
use Throwable;

/**
 * Base Exception
 */
class BaseException extends Exception
{
    /**
     * @var array
     */
    private array $errors;

    /**
     * @param string $message
     * @param array $errors
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $message = "",
        array $errors = [],
        int $code = 0,
        ?Throwable $previous = null
    )
    {
        $this->errors = $errors;

        parent::__construct(
            $message,
            $code,
            $previous
        );
    }

    /**
     *
     * Error List
     *
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }
}
