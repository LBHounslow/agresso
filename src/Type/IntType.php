<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Type;

use LBHounslow\Agresso\Exception\InvalidTypeLengthException;
use LBHounslow\Agresso\Exception\InvalidTypeValueLengthException;
use LBHounslow\Agresso\Exception\InvalidTypeValueOutOfRangeException;

final class IntType extends BaseType
{
    const MAX_LENGTH = 11;
    const MAX_VALUE = 99999999999;
    const MIN_VALUE = -99999999999;

    /**
     * @param int $length
     * @param int|null $value
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function __construct(int $length, int $value = null)
    {
        parent::__construct(
            $this->checkLengthDoesNotExceedMaxLength($length),
            $this->checkValueIsWithinRange($value, $length)
        );
    }

    /**
     * @param int $length
     * @return int
     * @throws InvalidTypeLengthException
     */
    public function checkLengthDoesNotExceedMaxLength(int $length)
    {
        if ($length > self::MAX_LENGTH) {
            throw new InvalidTypeLengthException($length, self::MAX_LENGTH);
        }
        return $length;
    }

    /**
     * @param mixed $value
     * @param int $length
     * @throws InvalidTypeValueLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function checkValueIsWithinRange($value, int $length)
    {
        if ($value !== null) {
            if ($value > self::MAX_VALUE || $value < self::MIN_VALUE) {
                throw new InvalidTypeValueOutOfRangeException((string) $value, self::MIN_VALUE, self::MAX_VALUE);
            }
            if (strlen((string) $value) > $length) {
                throw new InvalidTypeValueLengthException((string) $value, $length);
            }
        }
        return $value;
    }

    /**
     * @return int|null
     */
    public function getValue()
    {
        return parent::getValue() ? (int) parent::getValue() : parent::getValue();
    }

    /**
     * @return string
     */
    public function getPaddedValue()
    {
        return str_pad(
            $this->getValue() ? (string) $this->getValue() : '',
            $this->getLength()
        );
    }

    /**
     * @inheritDoc
     */
    public function getType2()
    {
        return TypeInterface::NUMERIC;
    }
}