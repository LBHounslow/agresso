<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Type;

interface TypeInterface
{
    const ALPHANUMERIC = 'A';
    const NUMERIC = 'N';
    const DATE = 'D';

    /**
     * @return int|string
     */
    public function getValue();

    /**
     * @return string
     */
    public function getPaddedValue();

    /**
     * @return int
     */
    public function getLength();

    /**
     * @return string
     */
    public function getType2();
}