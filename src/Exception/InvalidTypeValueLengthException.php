<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Exception;

use Throwable;

class InvalidTypeValueLengthException extends \Exception
{
    /**
     * @param string $value
     * @param int $length
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $value, int $length, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            vsprintf('Value %s exceeds field length of %d', [$value, $length]),
            $code,
            $previous
        );
    }
}