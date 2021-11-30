<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Exception;

use Throwable;

class InvalidTypeLengthException extends \Exception
{
    /**
     * @param int $length
     * @param int $maxLength
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(int $length, int $maxLength, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            vsprintf('Length %d exceeds max length of %d', [$length, $maxLength]),
            $code,
            $previous
        );
    }
}