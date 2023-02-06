<?php

namespace App\Sanitisers;

class StringSanitiser
{
    /**
     * Sanitises a string
     *
     * @param string|null $string
     * @return string
     */
    public static function sanitiseString(?string $sanitiseData): string
    {
        if ($sanitiseData === null) {
            return '';
        }

        $clean = filter_var($sanitiseData, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        return trim($clean);
    }
}
