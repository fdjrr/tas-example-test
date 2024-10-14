<?php

namespace App\Helpers;

class StringHelper
{
    public static function first($string)
    {
        $exp = explode(' ', $string);
        return (count($exp) > 1) ? $exp[0] : $string;
    }
}
