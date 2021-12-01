<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\Agresso\Exception\InvalidTypeValueOutOfRangeException;
use PHPUnit\Framework\TestCase;

class InvalidTypeValueOutOfRangeExceptionTest extends TestCase
{
    public function testItSetsExceptionBodyCorrectlyDefault()
    {
        $result = new InvalidTypeValueOutOfRangeException((string) 123, -20, 20);
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals("Value '123' should be between -20 and 20", $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }

    public function testItSetsExceptionBodyCorrectlyWithUnit()
    {
        $result = new InvalidTypeValueOutOfRangeException('String is too long', 1, 5, 'characters in length');
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals("Value 'String is too long' should be between 1 and 5 characters in length", $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }
}