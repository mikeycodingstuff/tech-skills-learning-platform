<?php

namespace App\Validators;

use App\CustomExceptions\InvalidTopicException;

class StringValidator
{
    /**
     * Checks if a string is empty and whether it is <= a given length
     *
     * @param string $validateData
     * @param integer $length
     * @return string
     */
    public static function validateExistsAndLength(string $validateData, int $length, string $fieldName): string
    {
        if (!empty($validateData) && strlen($validateData) <= $length) {
            return $validateData;
        } else {
            throw new InvalidTopicException($fieldName . ' is either empty or exceeds character limit');
        }
    }
}
