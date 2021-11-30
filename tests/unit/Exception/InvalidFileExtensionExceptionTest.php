<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\Agresso\Exception\InvalidFileExtensionException;
use PHPUnit\Framework\TestCase;

class InvalidFileExtensionExceptionTest extends TestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $result = new InvalidFileExtensionException('Expected .dat extension, got .xlsx');
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals('Expected .dat extension, got .xlsx', $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }
}