<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\Agresso\Exception\InvalidTypeValueLengthException;
use PHPUnit\Framework\TestCase;

class InvalidTypeValueLengthExceptionTest extends TestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $result = new InvalidTypeValueLengthException((string) 150, 2);
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals('Value 150 exceeds field length of 2', $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }
}