<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\Agresso\Exception\FolderNotWriteableException;
use PHPUnit\Framework\TestCase;

class FolderNotWriteableExceptionTest extends TestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $result = new FolderNotWriteableException('/path/to/folder');
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals("Cannot write to path '/path/to/folder'", $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }
}