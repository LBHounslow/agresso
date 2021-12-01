<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Entity;

class Journal
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \SplFileInfo
     */
    private $file;

    /**
     * @var JournalEntry[]
     */
    private $journalEntries = [];

    /**
     * @param array $journalEntries
     */
    public function __construct(array $journalEntries = [])
    {
        $this->addJournalEntries($journalEntries);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Journal
     */
    public function setName(string $name): Journal
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \SplFileInfo
     */
    public function getFile(): \SplFileInfo
    {
        return $this->file;
    }

    /**
     * @param \SplFileInfo $file
     * @return Journal
     */
    public function setFile(\SplFileInfo $file): Journal
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @param JournalEntry $journalEntry
     * @return Journal
     */
    public function addJournalEntry(JournalEntry $journalEntry): Journal
    {
        $this->journalEntries[] = $journalEntry;
        return $this;
    }

    /**
     * @param JournalEntry[] $journalEntries
     * @return $this
     */
    public function addJournalEntries(array $journalEntries)
    {
        $this->journalEntries = array_values(
            array_merge($this->journalEntries, $journalEntries)
        );
        return $this;
    }

    /**
     * @return JournalEntry[]
     */
    public function getJournalEntries()
    {
        return $this->journalEntries;
    }
}