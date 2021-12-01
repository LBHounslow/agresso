<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Type;

final class DateType extends BaseType
{
    const DEFAULT_LENGTH = 8;
    const DEFAULT_FORMAT = 'Ymd';

    /**
     * @param \DateTime|null $value
     */
    public function __construct(\DateTime $value = null)
    {
        parent::__construct(self::DEFAULT_LENGTH, $value);
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        return parent::getValue() instanceof \DateTime
            ? parent::getValue()->format(self::DEFAULT_FORMAT)
            : parent::getValue();
    }

    /**
     * @return string
     */
    public function getPaddedValue()
    {
        return str_pad(
            $this->getValue() ? $this->getValue() : '',
            $this->getLength()
        );
    }

    /**
     * @inheritDoc
     */
    public function getType2()
    {
        return TypeInterface::DATE;
    }
}