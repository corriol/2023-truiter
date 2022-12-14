<?php

namespace App\Helpers;

use InvalidArgumentException;

class Validator
{
    /**
     * @param string $value
     * @param int $min
     * @param int $max
     * @param string $message
     * @return bool
     * @throws InvalidArgumentException
     */
    static function lengthBetween(string $value,int $min,int $max, string $message = ''): bool {

        if (strlen($value) >= $min && strlen($value)<=$max)
            return true;

        if (empty($message))
            $message = "Value (%s) must contain between %d and %d characters";
        throw new InvalidArgumentException(sprintf($message, $value, $min, $max));
    }
}