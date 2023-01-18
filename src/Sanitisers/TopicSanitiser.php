<?php

namespace App\Sanitisers;

class TopicSanitiser
{
    /**
     * Sanitises the strings in the topic array
     *
     * @param array $topic
     * @return array
     */
    public static function sanitiseTopic(array $topic): array
    {
        $topic['name'] = StringSanitiser::sanitiseString($topic['name']);
        $topic['status'] = StringSanitiser::sanitiseString($topic['name']);
        $topic['resources'] = StringSanitiser::sanitiseString($topic['name']);

        return $topic;
    }
}