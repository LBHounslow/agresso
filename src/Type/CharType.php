<?php

declare(strict_types=1);

namespace LBHounslow\Agresso\Type;

use LBHounslow\Agresso\Exception\InvalidTypeLengthException;
use LBHounslow\Agresso\Exception\InvalidTypeValueOutOfRangeException;

final class CharType extends BaseType
{
    const DEFAULT_LENGTH = 25;
    const MAX_LENGTH = 255;

    /**
     * @param int $length
     * @param string|null $value
     * @throws InvalidTypeLengthException
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function __construct(int $length = self::DEFAULT_LENGTH, string $value = null)
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
     * @param string|null $value
     * @param int $length
     * @throws InvalidTypeValueOutOfRangeException
     */
    public function checkValueIsWithinRange($value, int $length)
    {
        if ($value !== null) {
            if (strlen($value) <= 0 || strlen($value) > $length) {
                throw new InvalidTypeValueOutOfRangeException((string) $value, 1, $length, 'characters in length');
            }
        }
        return $value;
    }

    /**
     * @inheritDoc
     */
    public function getType2()
    {
        return TypeInterface::ALPHANUMERIC;
    }
}