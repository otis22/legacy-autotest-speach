<?php

namespace Otis22\BeerMeetup;

class Math
{
    public static function factorial(int $n): int {
        if ($n === 0) {
            return 1;
        }
        if ($n === 1) {
            return 1;
        }
        return $n * self::factorial($n - 1);
    }
}