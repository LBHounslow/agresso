<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Type;

use LBHounslow\Agresso\Exception\InvalidTypeValueOutOfRangeException;

/**
 * PHP's int type (PHP_INT_MIN to PHP_INT_MAX) is sufficient to store
 * monetary values in pence
 */
final class MoneyType extends BaseType
{
    const DEFAULT_LENGTH = 20;
    const MAX_VALUE = PHP_INT_MAX;
    const MIN_VALUE = PHP_INT_MIN;

    /**
     * @param int|null $value  Amount in pence
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function __construct(int $value = null)
    {
        parent::__construct(self::DEFAULT_LENGTH, $this->checkValueIsWithinRange($value));
    }

    /**
     * @param mixed $value
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function checkValueIsWithinRange($value)
    {
        if ($value !== null) {
            if ($value > self::MAX_VALUE || $value < self::MIN_VALUE) {
                throw new InvalidTypeValueOutOfRangeException((string) $value, self::MIN_VALUE, self::MAX_VALUE);
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