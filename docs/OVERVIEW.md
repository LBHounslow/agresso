## Hounslow Agresso Finance File Export

This library is based on the [Agresso 5.5 format](Agresso-5-5-Format.xlsx).

### Overview

In this code library, a [JournalEntry](../src/Entity/JournalEntry.php) is the replication of one row of data in a [Journal](../src/Entity/Journal.php). 
Each [JournalEntry](../src/Entity/JournalEntry.php) includes  all the columns defined in 
the [Agresso 5.5 format](Agresso-5-5-Format.xlsx). 

An extract from the [Agresso 5.5 format](Agresso-5-5-Format.xlsx) file, showing some of the columns:

| # | Internal name | Type | Type2 | Len | From | To | Description |
| --- | --- | --- | --- | --- |--- |--- |--- |
| 1 | batch_id | **c25** | A | 25 | 1 | 25 | Batch ID from the external system |
| 24 | description | **c255** | A | 255 | 491 | 745 | Free text |
| 20 | number_1 | **i4** | N | 11 | 420 | 430 | Number field with leading sign |
| 27 | voucher_no | **bigint** | N | 15 | 762 | 776 | Free choice when ordering GL07 |
| 21 | value_1 | **f8** | N | 20 | 431 | 450 | Amount (multiplied by 100) |
| 18 | cur_amount | **money** | N | 20 | 380 | 399 | Amount in pence with leading sign |
| 25 | trans_date | **date** | D | 8 | 746 | 753 | Value date (YYYYMMDD, e.g. 19921231) |
| .. | .... | .... | .... | .... | .... | .... | .... |
| 66 | bank_acc_type | **c2** | A | 2 | 2059 | **2060** | Bank account type. Only used with sundry suppliers/customers. |

The value set for any of these columns needs to be within the limit (**Len**) of that column.

For example:
- `batch_id` should be an alphanumeric string (Type2 = **A**). It has a limit of 25 characters.
- `voucher_no` should be a numeric value (Type2 = **N**). It has a limit of 15 digits.
- `cur_amount` should be a numeric value (Type2 = **A**). It has a limit of 20 characters.
- `trans_date` should be a date string (Type2 = **D**). It has a limit of 20 characters.

A **type bridge** has been created so that we can match PHP types to the Agresso types _(eg. c25, c255, i4, bigint etc)_:

- [CharType](../src/Type/CharType.php)
- [IntType](../src/Type/IntType.php)
- [BigIntType](../src/Type/BigIntType.php)
- [FloatType](../src/Type/FloatType.php)
- [DateType](../src/Type/DateType.php)
- [MoneyType](../src/Type/MoneyType.php)

You are able to set the value of any of these columns using setters in the [src/Entity/JournalEntry](../src/Entity/JournalEntry.php) file.

Example:
```
$journalEntry = (new JournalEntry())
    ->setBatchId('BR')                  // CharType
    ->setVoucherNo(10000456607033)      // BigIntType
    ->setCurAmount(12500)               // MoneyType
    ->setTransDate(new \DateTime());    // DateType
    ... etc
```


When setting the value for a column, it needs to be the correct type and within the character limit. If the value exceeds the limits for a column, [InvalidTypeLengthException](../src/Exception/InvalidTypeLengthException.php), [InvalidTypeValueLengthException](../src/Exception/InvalidTypeValueLengthException.php) and [InvalidTypeValueOutOfRangeException](../src/Exception/InvalidTypeValueOutOfRangeException.php) exceptions will be thrown.

**NB: Every row in the journal.dat file needs to be a total of 2060 characters.**

So if the value is less than the character limit, it should pad the rest of that column with spaces so that the column data is equal to the character limit.

For example if your `batch_id`, which is limited to 25 chars, is "Your Batch ID" (13 chars long), then it should pad the rest of the column with spaces.

eg "Your Batch ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" (padded with 12 spaces)

Fortunately all this is all handled automatically when you generate the .dat file.

For instructions on how to create a Journal with JournalEntries and export them to a .dat file, see the [usage](USAGE.md) documentation.
