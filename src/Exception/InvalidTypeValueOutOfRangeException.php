<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Exception;

use Throwable;

class InvalidTypeValueOutOfRangeException extends \Exception
{
    /**
     * @param string $value
     * @param int $minValue
     * @param int $maxValue
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $value,
        int $minValue,
        int $maxValue,
        string $unit = '',
        $message = "",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(
            trim(vsprintf("Value '%s' should be between %d and %d %s", [$value, $minValue, $maxValue, $unit])),
            $code,
            $previous
        );
    }
}