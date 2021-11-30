<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Type;

/**
 * This Agresso type is shown as f8 (float?) Feel free to update
 * if you have more information on this type.
 */
final class FloatType extends BaseType
{
    const DEFAULT_LENGTH = 20;

    /**
     * @param float|null $value
     */
    public function __construct(float $value = null)
    {
        parent::__construct(self::DEFAULT_LENGTH, $value);
    }

    /**
     * @return float|null
     */
    public function getValue()
    {
        return parent::getValue() ? (float) parent::getValue() : parent::getValue();
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