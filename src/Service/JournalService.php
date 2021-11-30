<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Service;

use LBHounslow\Agresso\Entity\Journal;
use LBHounslow\Agresso\Exception\FileWriteException;
use LBHounslow\Agresso\Exception\FolderNotWriteableException;
use LBHounslow\Agresso\Exception\InvalidFileExtensionException;
use LBHounslow\Agresso\Exception\JournalEntriesNotFoundException;
use LBHounslow\Agresso\Handler\FileHandler;

class JournalService
{
    const FILE_WRITE_MODE = 'wb';
    const EXPECTED_FILE_EXTENSION = 'dat';

    /**
     * @var FileHandler
     */
    protected $fileHandler;

    /**
     * @param FileHandler $fileHandler
     */
    public function __construct(FileHandler $fileHandler)
    {
        $this->fileHandler = $fileHandler;
    }

    /**
     * @param Journal $journal
     * @return int
     * @throws FileWriteException
     * @throws FolderNotWriteableException
     * @throws JournalEntriesNotFoundException
     */
    public function exportJournal(Journal $journal)
    {
        if (!$journal->getJournalEntries()) {
            throw new JournalEntriesNotFoundException();
        }

        if ($journal->getFile()->getExtension() !== self::EXPECTED_FILE_EXTENSION) {
            throw new InvalidFileExtensionException(vsprintf('Expected .%s extension, got .%s', [self::EXPECTED_FILE_EXTENSION, $journal->getFile()->getExtension()]));
        }

        if (!$this->fileHandler->isWriteable($journal->getFile()->getPath())) {
            throw new FolderNotWriteableException($journal->getFile()->getPath());
        }

        if (!$this->fileHandler->getHandleToFile($journal->getFile()->getPathname(), self::FILE_WRITE_MODE)) {
            throw new FileWriteException($journal->getFile()->getPathname(), self::FILE_WRITE_MODE);
        }

        $lines = [];

        foreach ($journal->getJournalEntries() as $journalEntry) {
            $lines[] = [
                $journalEntry->getBatchId()->getPaddedValue(),
                $journalEntry->getInterface()->getPaddedValue(),
                $journalEntry->getVoucherType()->getPaddedValue(),
                $journalEntry->getTransType()->getPaddedValue(),
                $journalEntry->getClient()->getPaddedValue(),
                $journalEntry->getAccount()->getPaddedValue(),
                $journalEntry->getDim1()->getPaddedValue(),
                $journalEntry->getDim2()->getPaddedValue(),
                $journalEntry->getDim3()->getPaddedValue(),
                $journalEntry->getDim4()->getPaddedValue(),
                $journalEntry->getDim5()->getPaddedValue(),
                $journalEntry->getDim6()->getPaddedValue(),
                $journalEntry->getDim7()->getPaddedValue(),
                $journalEntry->getTaxCode()->getPaddedValue(),
                $journalEntry->getTaxSystem()->getPaddedValue(),
                $journalEntry->getCurrency()->getPaddedValue(),
                $journalEntry->getDcFlag()->getPaddedValue(),
                $journalEntry->getCurAmount()->getPaddedValue(),
                $journalEntry->getAmount()->getPaddedValue(),
                $journalEntry->getNumber1()->getPaddedValue(),
                $journalEntry->getValue1()->getPaddedValue(),
                $journalEntry->getValue2()->getPaddedValue(),
                $journalEntry->getValue3()->getPaddedValue(),
                $journalEntry->getDescription()->getPaddedValue(),
                $journalEntry->getTransDate()->getPaddedValue(),
                $journalEntry->getVoucherDate()->getPaddedValue(),
                $journalEntry->getVoucherNo()->getPaddedValue(),
                $journalEntry->getPeriod()->getPaddedValue(),
                $journalEntry->getTaxId()->getPaddedValue(),
                $journalEntry->getExtInvRef()->getPaddedValue(),
                $journalEntry->getExtRef()->getPaddedValue(),
                $journalEntry->getDueDate()->getPaddedValue(),
                $journalEntry->getDiscDate()->getPaddedValue(),
                $journalEntry->getDiscount()->getPaddedValue(),
                $journalEntry->getCommitment()->getPaddedValue(),
                $journalEntry->getOrderId()->getPaddedValue(),
                $journalEntry->getKid()->getPaddedValue(),
                $journalEntry->getPayTransfer()->getPaddedValue(),
                $journalEntry->getStatus()->getPaddedValue(),
                $journalEntry->getAparType()->getPaddedValue(),
                $journalEntry->getAparId()->getPaddedValue(),
                $journalEntry->getPayFlag()->getPaddedValue(),
                $journalEntry->getVoucherRef()->getPaddedValue(),
                $journalEntry->getSequenceRef()->getPaddedValue(),
                $journalEntry->getIntruleId()->getPaddedValue(),
                $journalEntry->getFactorShort()->getPaddedValue(),
                $journalEntry->getResponsible()->getPaddedValue(),
                $journalEntry->getAparName()->getPaddedValue(),
                $journalEntry->getAddress()->getPaddedValue(),
                $journalEntry->getProvince()->getPaddedValue(),
                $journalEntry->getPlace()->getPaddedValue(),
                $journalEntry->getBankAccount()->getPaddedValue(),
                $journalEntry->getPayMethod()->getPaddedValue(),
                $journalEntry->getVatRegNo()->getPaddedValue(),
                $journalEntry->getZipCode()->getPaddedValue(),
                $journalEntry->getCurrLicence()->getPaddedValue(),
                $journalEntry->getAccount2()->getPaddedValue(),
                $journalEntry->getBaseAmount()->getPaddedValue(),
                $journalEntry->getBaseCurr()->getPaddedValue(),
                $journalEntry->getPayTempId()->getPaddedValue(),
                $journalEntry->getAllocationKey()->getPaddedValue(),
                $journalEntry->getPeriodNo()->getPaddedValue(),
                $journalEntry->getClearingCode()->getPaddedValue(),
                $journalEntry->getSwift()->getPaddedValue(),
                $journalEntry->getArriveId()->getPaddedValue(),
                $journalEntry->getBankAccType()->getPaddedValue()
            ];
        }

        $handle = $this->fileHandler->getHandleToFile($journal->getFile()->getPathname(), self::FILE_WRITE_MODE);
        foreach ($lines as $line) {
            $this->fileHandler->writeToFile($handle, implode('', $line). PHP_EOL);
        }
        $this->fileHandler->closeHandleToFile($handle);

        return count($lines);
    }
}