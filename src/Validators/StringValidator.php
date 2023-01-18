<?php

namespace App\Validators;

class StringValidator
{
    /**
     * Checks if a string is empty and whether it is <= a given length
     *
     * @param string $validateData
     * @param integer $length
     * @return bool
     */
    public static function validateExistsAndLength(string $validateData, int $length): bool
    {
        if (!empty($validateData) && strlen($validateData) <= $length) {
            return true;
        }

        return false;
    }
}
