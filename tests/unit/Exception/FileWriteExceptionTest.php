<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\Agresso\Exception\FileWriteException;
use LBHounslow\Agresso\Service\JournalService;
use PHPUnit\Framework\TestCase;

class FileWriteExceptionTest extends TestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $result = new FileWriteException('/full/path/to/file.dat', JournalService::FILE_WRITE_MODE);
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals("Cannot create and open 'wb' stream to file '/full/path/to/file.dat'", $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }
}