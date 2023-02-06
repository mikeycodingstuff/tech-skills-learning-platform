<?php

namespace App\Validators;

use App\CustomExceptions\InvalidTopicException;

class StringValidator
{
    /**
     * Checks if a string is empty and whether it is <= a given length
     *
     * @param string $validateData string to be validated
     * @param integer $length length the string must not exceed
     * @param string $fieldName name of the field
     * @return string returns the string or throws an error message
     */
    public static function validateExistsAndLength(string $validateData, int $length, string $fieldName): string
    {
        if (!empty($validateData) && strlen($validateData) <= $length) {
            return $validateData;
        } else {
            throw new InvalidTopicException($fieldName . ' is either empty or exceeds character limit');
        }
    }

    /**
     * Checks if a string is <= a given length
     * If it NULL is passed returns NULL
     *
     * @param string $validateData string to be validated
     * @param integer $length length the string must not exceed
     * @param string $fieldName name of the field
     * @return string returns the string or NULL or throws an error message
     */
    public static function validateLength(?string $validateData, int $length, string $fieldName):  ?string
    {
        if (strlen($validateData) <= $length) {
            return $validateData;
        } else {
            throw new InvalidTopicException($fieldName . ' must not exceed ' . $length . ' characters');
        }
    }
}
