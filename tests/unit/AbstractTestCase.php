<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class AbstractTestCase extends TestCase
{
    const INT_TYPE_LENGTH_TOO_LONG = 20;
    const INT_TYPE_VALUE_TOO_LARGE = 1234567891011;
    const INT_TYPE_VALUE_TOO_SMALL = -1234567891011;
    const BIG_INT_TYPE_LENGTH_TOO_LONG = 16;
    const BIG_INT_TYPE_VALUE_TOO_LARGE = 1111111111111111; // max is 15 digits, this is 16
    const BIG_INT_TYPE_VALUE_TOO_SMALL = -1111111111111111; // max is 15 digits, this is 16
    const CHAR_TYPE_LENGTH_TOO_LONG = 300; // max length is 255
    const CHAR_TYPE_VALUE_TOO_LONG = 'hfafulzhzlctzrvdlhytgqwedmelvbwlcxsebxlbhtnufgnnvsgtnfpyianbvmjhmkyrfbyqxwmjddpvgxxaxquxyyjygaydtimjjbyvesoeqtvvbciuldbzrfijcsgwvbmpwiadugvxgmeapgaddwxjwxrdhukrqitqfxsuqsefolzminieopzjyfpzkssdbamvuedptfnkhuhhoaoxxpxkprvkkismhckykyclkopueqcrqbnilanoauygikebymbi'; // max length is 255
    const FLOAT_TYPE_LENGTH_TOO_LONG = 30; // max length is 20
    const FLOAT_TYPE_VALUE_TOO_LONG = '123456789101112.123456789'; // max length is 20
    const MONEY_TYPE_LENGTH_TOO_LONG = 30; // max length is 20
    const MONEY_TYPE_VALUE_TOO_LONG = PHP_INT_MAX + 1;
}