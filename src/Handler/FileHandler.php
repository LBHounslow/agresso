<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Handler;

class FileHandler
{
    /**
     * @param string $filePath
     * @return bool
     */
    public function isWriteable(string $filePath)
    {
        return is_writable($filePath);
    }

    /**
     * @param string $filePath
     * @param string $mode
     * @return false|resource
     */
    public function getHandleToFile(string $filePath, string $mode)
    {
        return fopen($filePath, $mode);
    }

    /**
     * @param resource $handle
     * @param string $data
     */
    public function writeToFile($handle, string $data)
    {
        fwrite($handle, $data);
    }

    /**
     * @param resource $handle
     */
    public function closeHandleToFile($handle)
    {
        fclose($handle);
    }
}