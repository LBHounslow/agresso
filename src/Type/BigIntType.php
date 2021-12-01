<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Type;

use LBHounslow\Agresso\Exception\InvalidTypeValueOutOfRangeException;

final class BigIntType extends BaseType
{
    const DEFAULT_LENGTH = 15;
    const MAX_VALUE = 999999999999999;
    const MIN_VALUE = -999999999999999;

    /**
     * @param int|null $value
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function __construct(int $value = null)
    {
        parent::__construct(self::DEFAULT_LENGTH, $this->checkValueIsWithinRange($value));
    }

    /**
     * @param int|null $value
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