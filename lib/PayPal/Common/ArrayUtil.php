<?php

namespace PayPal\Common;

class ArrayUtil
{
    public static function isAssocArray(array $arr): bool
    {
        foreach ($arr as $k => $v) {
            if (is_int($k)) {
                return false;
            }
        }
        return true;
    }
}
