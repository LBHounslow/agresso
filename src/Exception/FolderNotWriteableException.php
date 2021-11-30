<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Exception;

use Throwable;

class FolderNotWriteableException extends \Exception
{
    /**
     * @param string $folderPath
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $folderPath, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(
            sprintf("Cannot write to path '%s'", $folderPath),
            $code,
            $previous
        );
    }
}