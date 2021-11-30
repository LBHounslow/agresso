<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\Agresso\Entity\Journal;
use LBHounslow\Agresso\Entity\JournalEntry;
use PHPUnit\Framework\TestCase;

class JournalTest extends TestCase
{
    /**
     * @var Journal
     */
    private $journal;

    public function setUp(): void
    {
        $this->journal = new Journal();
        parent::setUp();
    }

    public function testItAcceptsJournalEntryArrayInConstructor()
    {
        $journalEntry = new JournalEntry();
        $journal = new Journal([$journalEntry]);
        $this->assertEquals($journalEntry, $journal->getJournalEntries()[0]);
    }

    public function testItSetsNameAndFileCorrectly()
    {
        $this->journal->setName('Name of journal');
        $this->assertEquals('Name of journal', $this->journal->getName());

        $this->journal->setFile(new \SplFileInfo('/full/path/to/file.ext'));
        $this->assertEquals('file.ext', $this->journal->getFile()->getFilename());
        $this->assertEquals('ext', $this->journal->getFile()->getExtension());
        $this->assertEquals('/full/path/to', $this->journal->getFile()->getPath());
    }

    public function testItSetsSingleJournalEntryCorrectly()
    {
        $this->journal->addJournalEntry(
            (new JournalEntry())
                ->setBatchId('Test')
        );

        $this->assertEquals(1, count($this->journal->getJournalEntries()));
        $this->assertInstanceOf(JournalEntry::class, $this->journal->getJournalEntries()[0]);
        $this->assertEquals('Test', $this->journal->getJournalEntries()[0]->getBatchId()->getValue());
    }

    public function testItSetsMultipleJournalEntriesCorrectly()
    {
        $journalEntry1 = (new JournalEntry())->setBatchId('One');
        $journalEntry2 = (new JournalEntry())->setBatchId('Two');

        $this->journal->addJournalEntries([$journalEntry1, $journalEntry2]);

        $this->assertEquals(2, count($this->journal->getJournalEntries()));
        $this->assertEquals('One', $this->journal->getJournalEntries()[0]->getBatchId()->getValue());
        $this->assertEquals('Two', $this->journal->getJournalEntries()[1]->getBatchId()->getValue());
    }

    public function testItStacksJournalEntriesCorrectly()
    {
        $journalEntry1 = (new JournalEntry())->setBatchId('One');
        $journalEntry2 = (new JournalEntry())->setBatchId('Two');
        $journalEntry3 = (new JournalEntry())->setBatchId('Three');

        $this->journal->addJournalEntry($journalEntry1); // add single
        $this->journal->addJournalEntries([$journalEntry2, $journalEntry3]); // add 2 more

        $this->assertEquals(3, count($this->journal->getJournalEntries()));
        $this->assertEquals('One', $this->journal->getJournalEntries()[0]->getBatchId()->getValue());
        $this->assertEquals('Two', $this->journal->getJournalEntries()[1]->getBatchId()->getValue());
        $this->assertEquals('Three', $this->journal->getJournalEntries()[2]->getBatchId()->getValue());
    }
}