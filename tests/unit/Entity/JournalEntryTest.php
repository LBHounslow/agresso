<?php

declare(strict_types=1);

namespace Tests\Unit\Entity;

use LBHounslow\Agresso\Entity\JournalEntry;
use LBHounslow\Agresso\Type\BigIntType;
use LBHounslow\Agresso\Type\CharType;
use LBHounslow\Agresso\Type\DateType;
use LBHounslow\Agresso\Type\FloatType;
use LBHounslow\Agresso\Type\IntType;
use LBHounslow\Agresso\Type\MoneyType;
use PHPUnit\Framework\TestCase;

class JournalEntryTest extends TestCase
{
    /**
     * @var JournalEntry
     */
    private $journalEntry;

    public function setUp(): void
    {
        $this->journalEntry = new JournalEntry();
        parent::setUp();
        
    }

    public function testAllSettersAndGetters()
    {
        $this->journalEntry->setBatchId('BR');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getBatchId());
        $this->assertEquals('BR', $this->journalEntry->getBatchId()->getValue());

        $this->journalEntry->setInterface('BI');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getInterface());
        $this->assertEquals('BI', $this->journalEntry->getInterface()->getValue());

        $this->journalEntry->setVoucherType('VoucherType');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getVoucherType());
        $this->assertEquals('VoucherType', $this->journalEntry->getVoucherType()->getValue());

        $this->journalEntry->setTransType(JournalEntry::TRANS_TYPE_GL);
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getTransType());
        $this->assertEquals(JournalEntry::TRANS_TYPE_GL, $this->journalEntry->getTransType()->getValue());

        $this->journalEntry->setClient('HB');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getClient());
        $this->assertEquals('HB', $this->journalEntry->getClient()->getValue());

        $this->journalEntry->setAccount('V12B');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getAccount());
        $this->assertEquals('V12B', $this->journalEntry->getAccount()->getValue());

        $this->journalEntry->setDim1('DIM1');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getDim1());
        $this->assertEquals('DIM1', $this->journalEntry->getDim1()->getValue());

        $this->journalEntry->setDim2('DIM2');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getDim2());
        $this->assertEquals('DIM2', $this->journalEntry->getDim2()->getValue());

        $this->journalEntry->setDim3('DIM3');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getDim3());
        $this->assertEquals('DIM3', $this->journalEntry->getDim3()->getValue());

        $this->journalEntry->setDim4('DIM4');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getDim4());
        $this->assertEquals('DIM4', $this->journalEntry->getDim4()->getValue());

        $this->journalEntry->setDim5('DIM5');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getDim5());
        $this->assertEquals('DIM5', $this->journalEntry->getDim5()->getValue());

        $this->journalEntry->setDim6('DIM6');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getDim6());
        $this->assertEquals('DIM6', $this->journalEntry->getDim6()->getValue());

        $this->journalEntry->setDim7('DIM7');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getDim7());
        $this->assertEquals('DIM7', $this->journalEntry->getDim7()->getValue());

        $this->journalEntry->setTaxCode('TAX-CODE');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getTaxCode());
        $this->assertEquals('TAX-CODE', $this->journalEntry->getTaxCode()->getValue());

        $this->journalEntry->setTaxSystem('TAX-SYSTEM');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getTaxSystem());
        $this->assertEquals('TAX-SYSTEM', $this->journalEntry->getTaxSystem()->getValue());

        $this->journalEntry->setCurrency('GBP');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getCurrency());
        $this->assertEquals('GBP', $this->journalEntry->getCurrency()->getValue());

        $this->journalEntry->setDcFlag(1);
        $this->assertInstanceOf(IntType::class, $this->journalEntry->getDcFlag());
        $this->assertEquals(1, $this->journalEntry->getDcFlag()->getValue());

        $this->journalEntry->setCurAmount(12500);
        $this->assertInstanceOf(MoneyType::class, $this->journalEntry->getCurAmount());
        $this->assertEquals(12500, $this->journalEntry->getCurAmount()->getValue());

        $this->journalEntry->setAmount(13500);
        $this->assertInstanceOf(MoneyType::class, $this->journalEntry->getAmount());
        $this->assertEquals(13500, $this->journalEntry->getAmount()->getValue());

        $this->journalEntry->setNumber1(123456);
        $this->assertInstanceOf(IntType::class, $this->journalEntry->getNumber1());
        $this->assertEquals(123456, $this->journalEntry->getNumber1()->getValue());

        $this->journalEntry->setValue1(56.123);
        $this->assertInstanceOf(FloatType::class, $this->journalEntry->getValue1());
        $this->assertEquals(56.123, $this->journalEntry->getValue1()->getValue());

        $this->journalEntry->setValue2(198000);
        $this->assertInstanceOf(MoneyType::class, $this->journalEntry->getValue2());
        $this->assertEquals(198000, $this->journalEntry->getValue2()->getValue());

        $this->journalEntry->setValue3(255000);
        $this->assertInstanceOf(MoneyType::class, $this->journalEntry->getValue3());
        $this->assertEquals(255000, $this->journalEntry->getValue3()->getValue());

        $this->journalEntry->setDescription('Description');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getDescription());
        $this->assertEquals('Description', $this->journalEntry->getDescription()->getValue());

        $this->journalEntry->setTransDate((new \DateTime())->setDate(2021, 11, 1));
        $this->assertInstanceOf(DateType::class, $this->journalEntry->getTransDate());
        $this->assertEquals((new \DateTime())->setDate(2021, 11, 1)->format(DateType::DEFAULT_FORMAT), $this->journalEntry->getTransDate()->getValue());

        $this->journalEntry->setVoucherDate((new \DateTime())->setDate(2021, 11, 1));
        $this->assertInstanceOf(DateType::class, $this->journalEntry->getVoucherDate());
        $this->assertEquals((new \DateTime())->setDate(2021, 11, 1)->format(DateType::DEFAULT_FORMAT), $this->journalEntry->getVoucherDate()->getValue());

        $this->journalEntry->setVoucherNo(10000456607033);
        $this->assertInstanceOf(BigIntType::class, $this->journalEntry->getVoucherNo());
        $this->assertEquals(10000456607033, $this->journalEntry->getVoucherNo()->getValue());

        $this->journalEntry->setPeriod(3500);
        $this->assertInstanceOf(IntType::class, $this->journalEntry->getPeriod());
        $this->assertEquals(3500, $this->journalEntry->getPeriod()->getValue());

        $this->journalEntry->setTaxId('X');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getTaxId());
        $this->assertEquals('X', $this->journalEntry->getTaxId()->getValue());

        $this->journalEntry->setExtInvRef('ext-inv-ref');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getExtInvRef());
        $this->assertEquals('ext-inv-ref', $this->journalEntry->getExtInvRef()->getValue());

        $this->journalEntry->setExtRef('ext-ref');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getExtRef());
        $this->assertEquals('ext-ref', $this->journalEntry->getExtRef()->getValue());

        $this->journalEntry->setDueDate((new \DateTime())->setDate(2021, 11, 1));
        $this->assertInstanceOf(DateType::class, $this->journalEntry->getDueDate());
        $this->assertEquals((new \DateTime())->setDate(2021, 11, 1)->format(DateType::DEFAULT_FORMAT), $this->journalEntry->getDueDate()->getValue());

        $this->journalEntry->setDiscDate((new \DateTime())->setDate(2021, 11, 1));
        $this->assertInstanceOf(DateType::class, $this->journalEntry->getDiscDate());
        $this->assertEquals((new \DateTime())->setDate(2021, 11, 1)->format(DateType::DEFAULT_FORMAT), $this->journalEntry->getDiscDate()->getValue());

        $this->journalEntry->setDiscount(450000);
        $this->assertInstanceOf(MoneyType::class, $this->journalEntry->getDiscount());
        $this->assertEquals(450000, $this->journalEntry->getDiscount()->getValue());

        $this->journalEntry->setCommitment('Commitment');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getCommitment());
        $this->assertEquals('Commitment', $this->journalEntry->getCommitment()->getValue());

        $this->journalEntry->setOrderId(3000548392);
        $this->assertInstanceOf(BigIntType::class, $this->journalEntry->getOrderId());
        $this->assertEquals(3000548392, $this->journalEntry->getOrderId()->getValue());

        $this->journalEntry->setKid('kid');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getKid());
        $this->assertEquals('kid', $this->journalEntry->getKid()->getValue());

        $this->journalEntry->setPayTransfer('PT');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getPayTransfer());
        $this->assertEquals('PT', $this->journalEntry->getPayTransfer()->getValue());

        $this->journalEntry->setStatus('S');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getStatus());
        $this->assertEquals('S', $this->journalEntry->getStatus()->getValue());

        $this->journalEntry->setAparType('A');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getAparType());
        $this->assertEquals('A', $this->journalEntry->getAparType()->getValue());

        $this->journalEntry->setAparId('Apar ID');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getAparId());
        $this->assertEquals('Apar ID', $this->journalEntry->getAparId()->getValue());

        $this->journalEntry->setPayFlag(1);
        $this->assertInstanceOf(IntType::class, $this->journalEntry->getPayFlag());
        $this->assertEquals(1, $this->journalEntry->getPayFlag()->getValue());

        $this->journalEntry->setVoucherRef(2000002392);
        $this->assertInstanceOf(BigIntType::class, $this->journalEntry->getVoucherRef());
        $this->assertEquals(2000002392, $this->journalEntry->getVoucherRef()->getValue());

        $this->journalEntry->setSequenceRef(1209012);
        $this->assertInstanceOf(IntType::class, $this->journalEntry->getSequenceRef());
        $this->assertEquals(1209012, $this->journalEntry->getSequenceRef()->getValue());

        $this->journalEntry->setIntruleId('Intrule ID');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getIntruleId());
        $this->assertEquals('Intrule ID', $this->journalEntry->getIntruleId()->getValue());

        $this->journalEntry->setFactorShort('Factor short');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getFactorShort());
        $this->assertEquals('Factor short', $this->journalEntry->getFactorShort()->getValue());

        $this->journalEntry->setResponsible('Responsible');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getResponsible());
        $this->assertEquals('Responsible', $this->journalEntry->getResponsible()->getValue());

        $this->journalEntry->setAparName('Apartment Name');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getAparName());
        $this->assertEquals('Apartment Name', $this->journalEntry->getAparName()->getValue());

        $this->journalEntry->setAddress('My Address');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getAddress());
        $this->assertEquals('My Address', $this->journalEntry->getAddress()->getValue());

        $this->journalEntry->setProvince('Province');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getProvince());
        $this->assertEquals('Province', $this->journalEntry->getProvince()->getValue());

        $this->journalEntry->setPlace('Place');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getPlace());
        $this->assertEquals('Place', $this->journalEntry->getPlace()->getValue());

        $this->journalEntry->setBankAccount('22830208422');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getBankAccount());
        $this->assertEquals('22830208422', $this->journalEntry->getBankAccount()->getValue());

        $this->journalEntry->setPayMethod('CC');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getPayMethod());
        $this->assertEquals('CC', $this->journalEntry->getPayMethod()->getValue());

        $this->journalEntry->setVatRegNo('Vat Reg Number');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getVatRegNo());
        $this->assertEquals('Vat Reg Number', $this->journalEntry->getVatRegNo()->getValue());

        $this->journalEntry->setZipCode('90210');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getZipCode());
        $this->assertEquals('90210', $this->journalEntry->getZipCode()->getValue());

        $this->journalEntry->setCurrLicence('Cur');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getCurrLicence());
        $this->assertEquals('Cur', $this->journalEntry->getCurrLicence()->getValue());

        $this->journalEntry->setAccount2('Account 2');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getAccount2());
        $this->assertEquals('Account 2', $this->journalEntry->getAccount2()->getValue());

        $this->journalEntry->setBaseAmount(125000);
        $this->assertInstanceOf(MoneyType::class, $this->journalEntry->getBaseAmount());
        $this->assertEquals(125000, $this->journalEntry->getBaseAmount()->getValue());

        $this->journalEntry->setBaseCurr(45000);
        $this->assertInstanceOf(MoneyType::class, $this->journalEntry->getBaseCurr());
        $this->assertEquals(45000, $this->journalEntry->getBaseCurr()->getValue());

        $this->journalEntry->setPayTempId('TEMP');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getPayTempId());
        $this->assertEquals('TEMP', $this->journalEntry->getPayTempId()->getValue());

        $this->journalEntry->setAllocationKey(123);
        $this->assertInstanceOf(IntType::class, $this->journalEntry->getAllocationKey());
        $this->assertEquals(123, $this->journalEntry->getAllocationKey()->getValue());

        $this->journalEntry->setPeriodNo(99);
        $this->assertInstanceOf(IntType::class, $this->journalEntry->getPeriodNo());
        $this->assertEquals(99, $this->journalEntry->getPeriodNo()->getValue());

        $this->journalEntry->setClearingCode('00-22-00');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getClearingCode());
        $this->assertEquals('00-22-00', $this->journalEntry->getClearingCode()->getValue());

        $this->journalEntry->setSwift('SWIFT');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getSwift());
        $this->assertEquals('SWIFT', $this->journalEntry->getSwift()->getValue());

        $this->journalEntry->setArriveId(100020303);
        $this->assertInstanceOf(BigIntType::class, $this->journalEntry->getArriveId());
        $this->assertEquals(100020303, $this->journalEntry->getArriveId()->getValue());

        $this->journalEntry->setBankAccType('CR');
        $this->assertInstanceOf(CharType::class, $this->journalEntry->getBankAccType());
        $this->assertEquals('CR', $this->journalEntry->getBankAccType()->getValue());
    }
}