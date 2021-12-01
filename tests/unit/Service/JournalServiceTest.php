<?php

declare(strict_types=1);

namespace Tests\Unit\Service;

use LBHounslow\Agresso\Entity\Journal;
use LBHounslow\Agresso\Entity\JournalEntry;
use LBHounslow\Agresso\Exception\FileWriteException;
use LBHounslow\Agresso\Exception\FolderNotWriteableException;
use LBHounslow\Agresso\Exception\InvalidFileExtensionException;
use LBHounslow\Agresso\Exception\JournalEntriesNotFoundException;
use LBHounslow\Agresso\Handler\FileHandler;
use LBHounslow\Agresso\Service\JournalService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class JournalServiceTest extends TestCase
{
    /**
     * @var JournalService
     */
    private $journalService;

    /**
     * @var MockObject|FileHandler
     */
    private $fileService;

    public function setUp(): void
    {
        $this->fileService = $this->getMockBuilder(FileHandler::class)->getMock();
        $this->journalService = new JournalService($this->fileService);
        parent::setUp();
    }

    public function testThatExportMethodThrowsExceptionWhenNoJournalEntriesExist()
    {
        $this->expectException(JournalEntriesNotFoundException::class);
        $this->journalService->exportJournal(new Journal());
    }

    public function testThatExportMethodThrowsInvalidFileExtensionExceptionForInvalidFileExtension()
    {
        $this->expectExceptionMessage(InvalidFileExtensionException::class);
        $this->expectExceptionMessage(sprintf('Expected .%s extension, got .xlsx', JournalService::EXPECTED_FILE_EXTENSION));
        $journal = (new Journal())
            ->setName('My Journal')
            ->setFile(new \SplFileInfo('/full/path/to/file.xlsx'))
            ->addJournalEntry(new JournalEntry());
        $this->journalService->exportJournal($journal);
    }

    public function testThatExportMethodThrowsFolderNotWriteableExceptionWhenFilePathIsNotWriteable()
    {
        $this->expectException(FolderNotWriteableException::class);
        $this->expectExceptionMessage("Cannot write to path '/full/path/to'");
        $this->fileService
            ->expects($this->once())
            ->method('isWriteable')
            ->will($this->returnValue(false));

        $journal = (new Journal())
            ->setName('My Journal')
            ->setFile(new \SplFileInfo('/full/path/to/file.dat'))
            ->addJournalEntry(new JournalEntry());
        $this->journalService->exportJournal($journal);
    }

    public function testThatExportMethodThrowsFileWriteExceptionWhenFilePathIsNotWriteable()
    {
        $this->expectException(FileWriteException::class);
        $this->expectExceptionMessage("Cannot create and open 'wb' stream to file '/full/path/to/file.dat'");
        $this->fileService
            ->expects($this->once())
            ->method('isWriteable')
            ->will($this->returnValue(true));
        $this->fileService
            ->expects($this->once())
            ->method('getHandleToFile')
            ->will($this->returnValue(false));

        $journal = (new Journal())
            ->setName('My Journal')
            ->setFile(new \SplFileInfo('/full/path/to/file.dat'))
            ->addJournalEntry(new JournalEntry());
        $this->journalService->exportJournal($journal);
    }

    /**
     * @param array $journalEntries
     * @param int $expectedLinesWrittenCount
     * @dataProvider journalEntryLinesWrittenDataProvider
     */
    public function testThatExportMethodReturnsCorrectNumberOfLinesWritten(array $journalEntries, int $expectedLinesWrittenCount)
    {
        $this->fileService
            ->expects($this->any())
            ->method('isWriteable')
            ->will($this->returnValue(true));
        $this->fileService
            ->expects($this->any())
            ->method('getHandleToFile')
            ->will($this->returnValue(true));

        $journal = (new Journal())
            ->setName('My Journal')
            ->setFile(new \SplFileInfo('/full/path/to/file.dat'))
            ->addJournalEntries($journalEntries);
        $this->journalService->exportJournal($journal);
        $this->assertEquals($expectedLinesWrittenCount, $this->journalService->exportJournal($journal));
    }

    public function journalEntryLinesWrittenDataProvider()
    {
        return [
            [[new JournalEntry()], 1],
            [
                [
                    new JournalEntry(),
                    new JournalEntry(),
                    new JournalEntry()
                ],
                3
            ]
        ];
    }
}