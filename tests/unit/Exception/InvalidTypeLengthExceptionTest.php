<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\Agresso\Exception\InvalidTypeLengthException;
use PHPUnit\Framework\TestCase;

class InvalidTypeLengthExceptionTest extends TestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $result = new InvalidTypeLengthException(14, 10);
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals('Length 14 exceeds max length of 10', $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }
}