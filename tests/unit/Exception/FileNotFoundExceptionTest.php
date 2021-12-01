<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\Agresso\Exception\FileNotFoundException;
use PHPUnit\Framework\TestCase;

class FileNotFoundExceptionTest extends TestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $result = new FileNotFoundException('File is required, use setFile() method to add an export file');
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals('File is required, use setFile() method to add an export file', $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }
}