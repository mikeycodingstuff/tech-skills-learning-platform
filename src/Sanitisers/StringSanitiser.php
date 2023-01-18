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
    public static function sanitiseString(?string $string): string
    {
        if ($string === null) {
            return '';
        }

        $clean = filter_var($string, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        return trim($clean);
    }
}
