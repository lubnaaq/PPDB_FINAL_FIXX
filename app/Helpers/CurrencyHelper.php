<?php

namespace App\Helpers;

class CurrencyHelper
{
    protected static $numbers = [
        0 => '',
        1 => 'satu',
        2 => 'dua',
        3 => 'tiga',
        4 => 'empat',
        5 => 'lima',
        6 => 'enam',
        7 => 'tujuh',
        8 => 'delapan',
        9 => 'sembilan',
        10 => 'sepuluh',
        11 => 'sebelas',
        12 => 'dua belas',
        13 => 'tiga belas',
        14 => 'empat belas',
        15 => 'lima belas',
        16 => 'enam belas',
        17 => 'tujuh belas',
        18 => 'delapan belas',
        19 => 'sembilan belas',
        20 => 'dua puluh',
        30 => 'tiga puluh',
        40 => 'empat puluh',
        50 => 'lima puluh',
        60 => 'enam puluh',
        70 => 'tujuh puluh',
        80 => 'delapan puluh',
        90 => 'sembilan puluh',
    ];

    protected static $scales = [
        100 => 'ratus',
        1000 => 'ribu',
        1000000 => 'juta',
        1000000000 => 'miliar',
        1000000000000 => 'triliun',
    ];

    public static function numberToWords($number)
    {
        if ($number == 0) {
            return 'nol';
        }

        if ($number < 0) {
            return 'negatif ' . self::numberToWords(abs($number));
        }

        if ($number < 20) {
            return self::$numbers[$number];
        }

        if ($number < 100) {
            return self::getWords($number, 10);
        }

        foreach (self::$scales as $scale => $word) {
            if ($number < $scale * 1000) {
                return self::getWords($number, $scale) . ' ' . $word;
            }
        }

        return '';
    }

    protected static function getWords($number, $divisor)
    {
        $quotient = intdiv($number, $divisor);
        $remainder = $number % $divisor;

        if ($quotient < 20) {
            $result = self::$numbers[$quotient];
        } else {
            $result = self::getWords($quotient, 10);
        }

        if ($remainder == 0) {
            return $result;
        }

        return $result . ' ' . self::numberToWords($remainder);
    }
}
