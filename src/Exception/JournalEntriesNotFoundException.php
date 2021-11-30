<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Exception;

use Throwable;

class JournalEntriesNotFoundException extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($code = 0, Throwable $previous = null)
    {
        parent::__construct(
            'No journal entries to export!',
            $code,
            $previous
        );
    }
}