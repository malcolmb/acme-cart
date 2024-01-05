<?php

namespace App;

class Utils
{
    public static function toPrice ($number): string
    {
        return "$" . number_format($number / 100, 2, '.', ',');
    }
}