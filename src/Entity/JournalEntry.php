<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Entity;

use LBHounslow\Agresso\Exception\InvalidTypeLengthException;
use LBHounslow\Agresso\Exception\InvalidTypeValueLengthException;
use LBHounslow\Agresso\Exception\InvalidTypeValueOutOfRangeException;
use LBHounslow\Agresso\Type\BigIntType;
use LBHounslow\Agresso\Type\CharType;
use LBHounslow\Agresso\Type\DateType;
use LBHounslow\Agresso\Type\FloatType;
use LBHounslow\Agresso\Type\IntType;
use LBHounslow\Agresso\Type\MoneyType;

class JournalEntry
{
    const TRANS_TYPE_GL = 'GL'; // GL=general ledger
    const TRANS_TYPE_AP = 'AP'; // AP=supplier invoice
    const TRANS_TYPE_AR = 'AR'; // AR=customer invoice
    const TRANS_TYPE_TX = 'TX'; // TX=tax accounts

    const VALID_TRANS_TYPES = [
        self::TRANS_TYPE_GL,
        self::TRANS_TYPE_AP,
        self::TRANS_TYPE_AR,
        self::TRANS_TYPE_TX,
    ];

    /**
     * Batch ID from the external system
     *
     * @var CharType
     */
    private $batch_id;

    /**
     * External system
     *
     * @var CharType
     */
    private $interface;

    /**
     * Transaction type. This must be a valid transaction type that has been setup in the Transaction types screen in Common
     *
     * @var CharType
     */
    private $voucher_type;

    /**
     * Transaction type (GL, AP, AR) GL=general ledger, AP=supplier invoice, AR=customer invoice, TX=tax accounts
     *
     * @var CharType
     */
    private $trans_type;

    /**
     * Must be in the company register
     *
     * @var CharType
     */
    private $client;

    /**
     * Account can be blank for AP and AR
     *
     * @var CharType
     */
    private $account;

    /**
     * Content determined by the account's account rule, e.g. Department
     *
     * @var CharType
     */
    private $dim_1;

    /**
     * Content determined by the account's account rule, e.g. Project
     *
     * @var CharType
     */
    private $dim_2;

    /**
     * Content determined by the account's account rule
     *
     * @var CharType
     */
    private $dim_3;

    /**
     * Content determined by the account's account rule
     *
     * @var CharType
     */
    private $dim_4;

    /**
     * Content determined by the account's account rule
     *
     * @var CharType
     */
    private $dim_5;

    /**
     * Content determined by the account's account rule
     *
     * @var CharType
     */
    private $dim_6;

    /**
     * Content determined by the account's account rule
     *
     * @var CharType
     */
    private $dim_7;

    /**
     * Valid code in accordance with the tax table
     *
     * @var CharType
     */
    private $tax_code;

    /**
     * Blank or valid tax system
     *
     * @var CharType
     */
    private $tax_system;

    /**
     * Currency code must be filled in
     *
     * @var CharType
     */
    private $currency;

    /**
     * 1 (Debit) / -1 (Credit) (only for debit_credit_accounting)
     *
     * @var IntType
     */
    private $dc_flag;

    /**
     * Amount in pence with leading sign
     *
     * @var MoneyType
     */
    private $cur_amount;

    /**
     * Amount in pence with leading sign
     *
     * @var MoneyType
     */
    private $amount;

    /**
     * Number field with leading sign
     *
     * @var IntType
     */
    private $number_1;

    /**
     * Amount (multiplied by 100)
     *
     * @var FloatType
     */
    private $value_1;

    /**
     * Amount3 in pence with leading sign
     *
     * @var MoneyType
     */
    private $value_2;

    /**
     * Amount4 in pence with leading sign
     *
     * @var MoneyType
     */
    private $value_3;

    /**
     * Free text
     *
     * @var CharType
     */
    private $description;

    /**
     * Value date (YYYYMMDD, e.g. 19921231)
     *
     * @var DateType
     */
    private $trans_date;

    /**
     * Invoice date (YYYYMMDD, e.g. 19921231)
     *
     * @var DateType
     */
    private $voucher_date;

    /**
     * Free choice when ordering GL07
     *
     * @var BigIntType
     */
    private $voucher_no;

    /**
     * Will be used if filled in
     *
     * @var IntType
     */
    private $period;

    /**
     * Triangle trade indicator (EU)
     *
     * @var CharType
     */
    private $tax_id;

    /**
     * Invoice reference
     *
     * @var CharType
     */
    private $ext_inv_ref;

    /**
     * External reference
     *
     * @var CharType
     */
    private $ext_ref;

    /**
     * Due date on the AP/AR items (YYYYMMDD, e.g. 19921231)
     *
     * @var DateType
     */
    private $due_date;

    /**
     * Discount due date on the AP/AR items (YYYYMMDD, e.g. 19921231)
     *
     * @var DateType
     */
    private $disc_date;

    /**
     * Amount in pence with leading sign - free choice
     *
     * @var MoneyType
     */
    private $discount;

    /**
     * Contract Accounting / Commitment / Purchasing
     *
     * @var CharType
     */
    private $commitment;

    /**
     * Order number
     *
     * @var BigIntType
     */
    private $order_id;

    /**
     * KID reference
     *
     * @var CharType
     */
    private $kid;

    /**
     * Payment transfer method
     *
     * @var CharType
     */
    private $pay_transfer;

    /**
     * Invoice status
     *
     * @var CharType
     */
    private $status;

    /**
     * P = supplier (S), R = customer (C), Blank = not AP/AR
     *
     * @var CharType
     */
    private $apar_type;

    /**
     * AP/AR number
     *
     * @var CharType
     */
    private $apar_id;

    /**
     * 1=Advance/A-account
     *
     * @var IntType
     */
    private $pay_flag;

    /**
     * Transaction number which the current line will be matched against automatically
     *
     * @var BigIntType
     */
    private $voucher_ref;

    /**
     * Sequence number on the transaction which the current line will be matched against automatically
     *
     * @var IntType
     */
    private $sequence_ref;

    /**
     * Interest rule. Blank or valid rule
     *
     * @var CharType
     */
    private $intrule_id;

    /**
     * Payment recipient. Blank allowed
     *
     * @var CharType
     */
    private $factor_short;

    /**
     * Person responsible for authorisation
     *
     * @var CharType
     */
    private $responsible;

    /**
     * Only used with sundry suppliers/customers
     *
     * @var CharType
     */
    private $apar_name;

    /**
     * Only used with sundry suppliers/customers
     *
     * @var CharType
     */
    private $address;

    /**
     * Only used with sundry suppliers/customers. Note! Only the 40 first characters are in use for province.
     *
     * @var CharType
     */
    private $province;

    /**
     * Only used with sundry suppliers/customers. Note! Only the 40 first characters are in use for place.
     *
     * @var CharType
     */
    private $place;

    /**
     * Only used with sundry suppliers/customers
     *
     * @var CharType
     */
    private $bank_account;

    /**
     * The payment method.
     *
     * @var CharType
     */
    private $pay_method;

    /**
     * Only used with sundry suppliers/customers
     *
     * @var CharType
     */
    private $vat_reg_no;

    /**
     * Only used with sundry suppliers/customers
     *
     * @var CharType
     */
    private $zip_code;

    /**
     * ID for currency documentation
     *
     * @var CharType
     */
    private $curr_licence;

    /**
     * Account from which tax was calculated.
     *
     * @var CharType
     */
    private $account2;

    /**
     * Tax calculation base in company currency
     *
     * @var MoneyType
     */
    private $base_amount;

    /**
     * Tax calculation base in any currency
     *
     * @var MoneyType
     */
    private $base_curr;

    /**
     * ID for payment plan template. Must be a valid payment plan template defined in the Payment plan template window.
     *
     * @var CharType
     */
    private $pay_temp_id;

    /**
     * ID for accrual key. Must be a valid Accrual key defined in the Accrual key window.
     *
     * @var IntType
     */
    private $allocation_key;

    /**
     * The start period for the accrual. The number you enter is added to today’s period. For example, if the transaction
     * period is May (05) and you enter 04, the start period is 09.
     *
     * @var IntType
     */
    private $period_no;

    /**
     * Only used with sundry suppliers/customers
     *
     * @var CharType
     */
    private $clearing_code;

    /**
     * Only used with sundry suppliers/customers
     *
     * @var CharType
     */
    private $swift;

    /**
     * The current line’s registration number
     *
     * @var BigIntType
     */
    private $arrive_id;

    /**
     * Bank account type. Only used with sundry suppliers/customers.
     *
     * @var CharType
     */
    private $bank_acc_type;

    /**
     * @return CharType
     */
    public function getBatchId(): CharType
    {
        return $this->batch_id ?? new CharType();
    }

    /**
     * @param string $batch_id
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setBatchId(string $batch_id): JournalEntry
    {
        $this->batch_id = new CharType(25, $batch_id);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getInterface(): CharType
    {
        return $this->interface ?? new CharType();
    }

    /**
     * @param string $interface
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setInterface(string $interface): JournalEntry
    {
        $this->interface = new CharType(25, $interface);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getVoucherType(): CharType
    {
        return $this->voucher_type ?? new CharType();
    }

    /**
     * @param string $voucher_type
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setVoucherType(string $voucher_type): JournalEntry
    {
        $this->voucher_type = new CharType(25, $voucher_type);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getTransType(): CharType
    {
        return $this->trans_type ?? new CharType(2);
    }

    /**
     * @param string $trans_type
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     * @throws \InvalidArgumentException
     */
    public function setTransType(string $trans_type): JournalEntry
    {
        if (!in_array($trans_type, self::VALID_TRANS_TYPES)) {
            throw new \InvalidArgumentException(sprintf('Trans Type should be on of: %s', implode(',', self::VALID_TRANS_TYPES)));
        }
        $this->trans_type = new CharType(2, $trans_type);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getClient(): CharType
    {
        return $this->client ?? new CharType();
    }

    /**
     * @param string $client
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setClient(string $client): JournalEntry
    {
        $this->client = new CharType(25, $client);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getAccount(): CharType
    {
        return $this->account ?? new CharType();
    }

    /**
     * @param string $account
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setAccount(string $account): JournalEntry
    {
        $this->account = new CharType(25, $account);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getDim1(): CharType
    {
        return $this->dim_1 ?? new CharType();
    }

    /**
     * @param string $dim_1
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setDim1(string $dim_1): JournalEntry
    {
        $this->dim_1 = new CharType(25, $dim_1);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getDim2(): CharType
    {
        return $this->dim_2 ?? new CharType();
    }

    /**
     * @param string $dim_2
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setDim2(string $dim_2): JournalEntry
    {
        $this->dim_2 = new CharType(25, $dim_2);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getDim3(): CharType
    {
        return $this->dim_3 ?? new CharType();
    }

    /**
     * @param string $dim_3
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setDim3(string $dim_3): JournalEntry
    {
        $this->dim_3 = new CharType(25, $dim_3);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getDim4(): CharType
    {
        return $this->dim_4 ?? new CharType();
    }

    /**
     * @param string $dim_4
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setDim4(string $dim_4): JournalEntry
    {
        $this->dim_4 = new CharType(25, $dim_4);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getDim5(): CharType
    {
        return $this->dim_5 ?? new CharType();
    }

    /**
     * @param string $dim_5
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setDim5(string $dim_5): JournalEntry
    {
        $this->dim_5 = new CharType(25, $dim_5);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getDim6(): CharType
    {
        return $this->dim_6 ?? new CharType();
    }

    /**
     * @param string $dim_6
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setDim6(string $dim_6): JournalEntry
    {
        $this->dim_6 = new CharType(25, $dim_6);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getDim7(): CharType
    {
        return $this->dim_7 ?? new CharType();
    }

    /**
     * @param string $dim_7
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setDim7(string $dim_7): JournalEntry
    {
        $this->dim_7 = new CharType(25, $dim_7);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getTaxCode(): CharType
    {
        return $this->tax_code ?? new CharType();
    }

    /**
     * @param string $tax_code
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setTaxCode(string $tax_code): JournalEntry
    {
        $this->tax_code = new CharType(25, $tax_code);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getTaxSystem(): CharType
    {
        return $this->tax_system ?? new CharType();
    }

    /**
     * @param string $tax_system
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setTaxSystem(string $tax_system): JournalEntry
    {
        $this->tax_system = new CharType(25, $tax_system);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getCurrency(): CharType
    {
        return $this->currency ?? new CharType();
    }

    /**
     * @param string $currency
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setCurrency(string $currency): JournalEntry
    {
        $this->currency = new CharType(25, $currency);
        return $this;
    }

    /**
     * @return IntType
     */
    public function getDcFlag(): IntType
    {
        return $this->dc_flag ?? new IntType(2);
    }

    /**
     * @param int $dc_flag
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setDcFlag(int $dc_flag): JournalEntry
    {
        $this->dc_flag = new IntType(2, $dc_flag);
        return $this;
    }

    /**
     * @return MoneyType
     */
    public function getCurAmount(): MoneyType
    {
        return $this->cur_amount ?? new MoneyType();
    }

    /**
     * @param int $cur_amount
     * @return JournalEntry
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setCurAmount(int $cur_amount): JournalEntry
    {
        $this->cur_amount = new MoneyType($cur_amount);
        return $this;
    }

    /**
     * @return MoneyType
     */
    public function getAmount(): MoneyType
    {
        return $this->amount ?? new MoneyType();
    }

    /**
     * @param int $amount
     * @return JournalEntry
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setAmount(int $amount): JournalEntry
    {
        $this->amount = new MoneyType($amount);
        return $this;
    }

    /**
     * @return IntType
     */
    public function getNumber1(): IntType
    {
        return $this->number_1 ?? new IntType(11);
    }

    /**
     * @param int $number_1
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setNumber1(int $number_1): JournalEntry
    {
        $this->number_1 = new IntType(11, $number_1);
        return $this;
    }

    /**
     * @return FloatType
     */
    public function getValue1(): FloatType
    {
        return $this->value_1 ?? new FloatType();
    }

    /**
     * @param float $value_1
     * @return JournalEntry
     */
    public function setValue1(float $value_1): JournalEntry
    {
        $this->value_1 = new FloatType($value_1);
        return $this;
    }

    /**
     * @return MoneyType
     */
    public function getValue2(): MoneyType
    {
        return $this->value_2 ?? new MoneyType();
    }

    /**
     * @param int $value_2
     * @return JournalEntry
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setValue2(int $value_2): JournalEntry
    {
        $this->value_2 = new MoneyType($value_2);
        return $this;
    }

    /**
     * @return MoneyType
     */
    public function getValue3(): MoneyType
    {
        return $this->value_3 ?? new MoneyType();
    }

    /**
     * @param int $value_3
     * @return JournalEntry
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setValue3(int $value_3): JournalEntry
    {
        $this->value_3 = new MoneyType($value_3);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getDescription(): CharType
    {
        return $this->description ?? new CharType(255);
    }

    /**
     * @param string $description
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setDescription(string $description): JournalEntry
    {
        $this->description = new CharType(255, $description);
        return $this;
    }

    /**
     * @return DateType
     */
    public function getTransDate(): DateType
    {
        return $this->trans_date ?? new DateType();
    }

    /**
     * @param \DateTime $trans_date
     * @return JournalEntry
     */
    public function setTransDate(\DateTime $trans_date): JournalEntry
    {
        $this->trans_date = new DateType($trans_date);
        return $this;
    }

    /**
     * @return DateType
     */
    public function getVoucherDate(): DateType
    {
        return $this->voucher_date ?? new DateType();
    }

    /**
     * @param \DateTime $voucher_date
     * @return JournalEntry
     */
    public function setVoucherDate(\DateTime $voucher_date): JournalEntry
    {
        $this->voucher_date = new DateType($voucher_date);
        return $this;
    }

    /**
     * @return BigIntType
     */
    public function getVoucherNo(): BigIntType
    {
        return $this->voucher_no ?? new BigIntType();
    }

    /**
     * @param int $voucher_no
     * @return JournalEntry
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setVoucherNo(int $voucher_no): JournalEntry
    {
        $this->voucher_no = new BigIntType($voucher_no);
        return $this;
    }

    /**
     * @return IntType
     */
    public function getPeriod(): IntType
    {
        return $this->period ?? new IntType(6);
    }

    /**
     * @param int $period
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setPeriod(int $period): JournalEntry
    {
        $this->period = new IntType(6, $period);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getTaxId(): CharType
    {
        return $this->tax_id ?? new CharType(1);
    }

    /**
     * @param string $tax_id
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setTaxId(string $tax_id): JournalEntry
    {
        $this->tax_id = new CharType(1, $tax_id);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getExtInvRef(): CharType
    {
        return $this->ext_inv_ref ?? new CharType(100);
    }

    /**
     * @param string $ext_inv_ref
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setExtInvRef(string $ext_inv_ref): JournalEntry
    {
        $this->ext_inv_ref = new CharType(100, $ext_inv_ref);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getExtRef(): CharType
    {
        return $this->ext_ref ?? new CharType(255);
    }

    /**
     * @param string $ext_ref
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setExtRef(string $ext_ref): JournalEntry
    {
        $this->ext_ref = new CharType(255, $ext_ref);
        return $this;
    }

    /**
     * @return DateType
     */
    public function getDueDate(): DateType
    {
        return $this->due_date ?? new DateType();
    }

    /**
     * @param \DateTime $due_date
     * @return JournalEntry
     */
    public function setDueDate(\DateTime $due_date): JournalEntry
    {
        $this->due_date = new DateType($due_date);
        return $this;
    }

    /**
     * @return DateType
     */
    public function getDiscDate(): DateType
    {
        return $this->disc_date ?? new DateType();
    }

    /**
     * @param \DateTime $disc_date
     * @return JournalEntry
     */
    public function setDiscDate(\DateTime $disc_date): JournalEntry
    {
        $this->disc_date = new DateType($disc_date);
        return $this;
    }

    /**
     * @return MoneyType
     */
    public function getDiscount(): MoneyType
    {
        return $this->discount ?? new MoneyType();
    }

    /**
     * @param int $discount
     * @return JournalEntry
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setDiscount(int $discount): JournalEntry
    {
        $this->discount = new MoneyType($discount);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getCommitment(): CharType
    {
        return $this->commitment ?? new CharType();
    }

    /**
     * @param string $commitment
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setCommitment(string $commitment): JournalEntry
    {
        $this->commitment = new CharType(25, $commitment);
        return $this;
    }

    /**
     * @return BigIntType
     */
    public function getOrderId(): BigIntType
    {
        return $this->order_id ?? new BigIntType();
    }

    /**
     * @param int $order_id
     * @return JournalEntry
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setOrderId(int $order_id): JournalEntry
    {
        $this->order_id = new BigIntType($order_id);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getKid(): CharType
    {
        return $this->kid ?? new CharType(27);
    }

    /**
     * @param string $kid
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setKid(string $kid): JournalEntry
    {
        $this->kid = new CharType(27, $kid);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getPayTransfer(): CharType
    {
        return $this->pay_transfer ?? new CharType(2);
    }

    /**
     * @param string $pay_transfer
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setPayTransfer(string $pay_transfer): JournalEntry
    {
        $this->pay_transfer = new CharType(2, $pay_transfer);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getStatus(): CharType
    {
        return $this->status ?? new CharType(1);
    }

    /**
     * @param string $status
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setStatus(string $status): JournalEntry
    {
        $this->status = new CharType(1, $status);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getAparType(): CharType
    {
        return $this->apar_type ?? new CharType(1);
    }

    /**
     * @param string $apar_type
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setAparType(string $apar_type): JournalEntry
    {
        $this->apar_type = new CharType(1, $apar_type);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getAparId(): CharType
    {
        return $this->apar_id ?? new CharType();
    }

    /**
     * @param string $apar_id
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setAparId(string $apar_id): JournalEntry
    {
        $this->apar_id = new CharType(25, $apar_id);
        return $this;
    }

    /**
     * @return IntType
     */
    public function getPayFlag(): IntType
    {
        return $this->pay_flag ?? new IntType(1);
    }

    /**
     * @param int $pay_flag
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setPayFlag(int $pay_flag): JournalEntry
    {
        $this->pay_flag = new IntType(1, $pay_flag);
        return $this;
    }

    /**
     * @return BigIntType
     */
    public function getVoucherRef(): BigIntType
    {
        return $this->voucher_ref ?? new BigIntType();
    }

    /**
     * @param int $voucher_ref
     * @return JournalEntry
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setVoucherRef(int $voucher_ref): JournalEntry
    {
        $this->voucher_ref = new BigIntType($voucher_ref);
        return $this;
    }

    /**
     * @return IntType
     */
    public function getSequenceRef(): IntType
    {
        return $this->sequence_ref ?? new IntType(9);
    }

    /**
     * @param int $sequence_ref
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setSequenceRef(int $sequence_ref): JournalEntry
    {
        $this->sequence_ref = new IntType(9, $sequence_ref);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getIntruleId(): CharType
    {
        return $this->intrule_id ?? new CharType();
    }

    /**
     * @param string $intrule_id
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setIntruleId(string $intrule_id): JournalEntry
    {
        $this->intrule_id = new CharType(25, $intrule_id);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getFactorShort(): CharType
    {
        return $this->factor_short ?? new CharType();
    }

    /**
     * @param string $factor_short
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setFactorShort(string $factor_short): JournalEntry
    {
        $this->factor_short = new CharType(25, $factor_short);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getResponsible(): CharType
    {
        return $this->responsible ?? new CharType();
    }

    /**
     * @param string $responsible
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setResponsible(string $responsible): JournalEntry
    {
        $this->responsible = new CharType(25, $responsible);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getAparName(): CharType
    {
        return $this->apar_name ?? new CharType(255);
    }

    /**
     * @param string $apar_name
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setAparName(string $apar_name): JournalEntry
    {
        $this->apar_name = new CharType(255, $apar_name);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getAddress(): CharType
    {
        return $this->address ?? new CharType(160);
    }

    /**
     * @param string $address
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setAddress(string $address): JournalEntry
    {
        $this->address = new CharType(160, $address);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getProvince(): CharType
    {
        return $this->province ?? new CharType(40);
    }

    /**
     * @param string $province
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setProvince(string $province): JournalEntry
    {
        $this->province = new CharType(40, $province);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getPlace(): CharType
    {
        return $this->place ?? new CharType(40);
    }

    /**
     * @param string $place
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setPlace(string $place): JournalEntry
    {
        $this->place = new CharType(40, $place);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getBankAccount(): CharType
    {
        return $this->bank_account ?? new CharType(35);
    }

    /**
     * @param string $bank_account
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setBankAccount(string $bank_account): JournalEntry
    {
        $this->bank_account = new CharType(35, $bank_account);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getPayMethod(): CharType
    {
        return $this->pay_method ?? new CharType(2);
    }

    /**
     * @param string $pay_method
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setPayMethod(string $pay_method): JournalEntry
    {
        $this->pay_method = new CharType(2, $pay_method);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getVatRegNo(): CharType
    {
        return $this->vat_reg_no ?? new CharType();
    }

    /**
     * @param string $vat_reg_no
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setVatRegNo(string $vat_reg_no): JournalEntry
    {
        $this->vat_reg_no = new CharType(25, $vat_reg_no);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getZipCode(): CharType
    {
        return $this->zip_code ?? new CharType(15);
    }

    /**
     * @param string $zip_code
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setZipCode(string $zip_code): JournalEntry
    {
        $this->zip_code = new CharType(15, $zip_code);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getCurrLicence(): CharType
    {
        return $this->curr_licence ?? new CharType(3);
    }

    /**
     * @param string $curr_licence
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setCurrLicence(string $curr_licence): JournalEntry
    {
        $this->curr_licence = new CharType(3, $curr_licence);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getAccount2(): CharType
    {
        return $this->account2 ?? new CharType();
    }

    /**
     * @param string $account2
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setAccount2(string $account2): JournalEntry
    {
        $this->account2 = new CharType(25, $account2);
        return $this;
    }

    /**
     * @return MoneyType
     */
    public function getBaseAmount(): MoneyType
    {
        return $this->base_amount ?? new MoneyType();
    }

    /**
     * @param int $base_amount
     * @return JournalEntry
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setBaseAmount(int $base_amount): JournalEntry
    {
        $this->base_amount = new MoneyType($base_amount);
        return $this;
    }

    /**
     * @return MoneyType
     */
    public function getBaseCurr(): MoneyType
    {
        return $this->base_curr ?? new MoneyType();
    }

    /**
     * @param int $base_curr
     * @return JournalEntry
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setBaseCurr(int $base_curr): JournalEntry
    {
        $this->base_curr = new MoneyType($base_curr);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getPayTempId(): CharType
    {
        return $this->pay_temp_id ?? new CharType(4);
    }

    /**
     * @param string $pay_temp_id
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setPayTempId(string $pay_temp_id): JournalEntry
    {
        $this->pay_temp_id = new CharType(4, $pay_temp_id);
        return $this;
    }

    /**
     * @return IntType
     */
    public function getAllocationKey(): IntType
    {
        return $this->allocation_key ?? new IntType(3);
    }

    /**
     * @param int $allocation_key
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setAllocationKey(int $allocation_key): JournalEntry
    {
        $this->allocation_key = new IntType(3, $allocation_key);
        return $this;
    }

    /**
     * @return IntType
     */
    public function getPeriodNo(): IntType
    {
        return $this->period_no ?? new IntType(2);
    }

    /**
     * @param int $period_no
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setPeriodNo(int $period_no): JournalEntry
    {
        $this->period_no = new IntType(2, $period_no);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getClearingCode(): CharType
    {
        return $this->clearing_code ?? new CharType(13);
    }

    /**
     * @param string $clearing_code
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setClearingCode(string $clearing_code): JournalEntry
    {
        $this->clearing_code = new CharType(13, $clearing_code);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getSwift(): CharType
    {
        return $this->swift ?? new CharType(11);
    }

    /**
     * @param string $swift
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setSwift(string $swift): JournalEntry
    {
        $this->swift = new CharType(11, $swift);
        return $this;
    }

    /**
     * @return BigIntType
     */
    public function getArriveId(): BigIntType
    {
        return $this->arrive_id ?? new BigIntType();
    }

    /**
     * @param int $arrive_id
     * @return JournalEntry
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setArriveId(int $arrive_id): JournalEntry
    {
        $this->arrive_id = new BigIntType($arrive_id);
        return $this;
    }

    /**
     * @return CharType
     */
    public function getBankAccType(): CharType
    {
        return $this->bank_acc_type ?? new CharType(2);
    }

    /**
     * @param string $bank_acc_type
     * @return JournalEntry
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function setBankAccType(string $bank_acc_type): JournalEntry
    {
        $this->bank_acc_type = new CharType(2, $bank_acc_type);
        return $this;
    }
}