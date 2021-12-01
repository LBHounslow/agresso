<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Type;

abstract class BaseType implements TypeInterface
{
    /**
     * @var int
     */
    private $length;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param int $length
     * @param mixed $value
     */
    public function __construct(int $length, $value = null)
    {
        $this->length = $length;
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function getPaddedValue()
    {
        return str_pad((string) $this->getValue(), $this->getLength());
    }
}