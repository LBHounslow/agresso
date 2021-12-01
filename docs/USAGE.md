## Hounslow Agresso Finance File Export

**NOTE:** When working with Journal files (`\SplFileInfo`), it will only accept files with the **.dat** extension.

### Usage

#### Create a Journal and add a single JournalEntry file

```
try {
    $journal = (new Journal())
        ->setName('My Journal')
        ->addJournalEntry(
            (new JournalEntry())
                ->setBatchId('API')
                ->setInterface('BI')
                ->setTransType(JournalEntry::TRANS_TYPE_GL)
                ->setClient('HB')
                ->setAccount('V12B')
                ->setDim1('A2311')
                ->setDim2('CERT2')
                ->setCurrency('GBP')
                ->setCurAmount(125000)
                ->setAmount(125000)
                ->setDescription('Description')
                ->setTransDate(new \DateTime())
                ->setVoucherDate(new \DateTime())
                ->setPeriod(1)
                ->setExtInvRef('318')
                ->setExtRef('my external reference')
        );
} catch (\Exception $e) {
    // handle $e
}
```

#### Create a Journal and add multiple JournalEntries

```
$yourDataArray = [];

try {
    $journalEntries = [];
    
    // build Journal Entries
    foreach ($yourDataArray as $row) {
        $journalEntries[] = (new JournalEntry())
            ->setBatchId($row['batch_id'])
            ->setInterface('BI')
            ->setTransType(JournalEntry::TRANS_TYPE_GL)
            ->setClient('HB')
            ->setAccount($row['account'])
            ->setDim1($row['custom_field_1'])
            ->setDim2($row['custom_field_2'])
            ->setCurrency('GBP')
            ->setCurAmount($row['current_amount'])
            ->setAmount($row['amount'])
            ->setDescription($row['description'])
            ->setTransDate(new \DateTime())
            ->setVoucherDate(new \DateTime())
            ->setPeriod(1)
            ->setExtInvRef($row['external_invoice_reference'])
            ->setExtRef($row['external_reference']);
    }

    $journal = (new Journal())
        ->setName('My Journal')
        ->addJournalEntries($journalEntries);

} catch (\Exception $e) {
    // handle $e
}
```

#### Use the JournalService to export a "journal.dat" file
```
class YourClass
{
    /**
     * @var JournalService
     */
    protected $journalService;

    /**
     * @param JournalService $journalService
     */
    public function __construct(JournalService $journalService)
    {
        $this->journalService = $journalService;
    }

    public function execute()
    {
        try {
            // Build your Journal Entries....
            $journalEntries = [];

            // Must be .dat otherwise exception will be thrown
            $exportFile = new \SplFileInfo('/real/path/to/your/journal.dat');

            // Create Journal with Journal Entries
            $journal = (new Journal())
                ->setName('My Journal')
                ->addJournalEntries($journalEntries);
                ->setFile($exportFile);

            // Generate journal.dat file
            $this->journalService->exportJournal($journal);

        } catch (\Exception $e) {
            // handle $e
        }
    }
}
```

For examples, see [example.php](../example.php).
