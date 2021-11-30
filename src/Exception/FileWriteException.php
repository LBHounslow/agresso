<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Exception;

use Throwable;

class FileWriteException extends \Exception
{
    /**
     * @param string $filePath
     * @param string $mode
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $filePath, string $mode, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            vsprintf("Cannot create and open '%s' stream to file '%s'", [$mode, $filePath]),
            $code,
            $previous
        );
    }
}