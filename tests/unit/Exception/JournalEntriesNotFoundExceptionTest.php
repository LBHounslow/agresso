<?php

declare(strict_types=1);

namespace Tests\Unit\Exception;

use LBHounslow\Agresso\Exception\JournalEntriesNotFoundException;
use PHPUnit\Framework\TestCase;

class JournalEntriesNotFoundExceptionTest extends TestCase
{
    public function testItSetsExceptionBodyCorrectly()
    {
        $result = new JournalEntriesNotFoundException();
        $this->assertInstanceOf(\Exception::class, $result);
        $this->assertEquals('No journal entries to export!', $result->getMessage());
        $this->assertEquals(0, $result->getCode());
    }
}