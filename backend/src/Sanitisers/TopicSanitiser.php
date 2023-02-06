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
        $topic['topic_name'] = StringSanitiser::sanitiseString($topic['topic_name']);
        $topic['status'] = StringSanitiser::sanitiseString($topic['status']);
        if (isset($topic['resources'])) {
            $topic['resources'] = StringSanitiser::sanitiseString($topic['resources']);
        }

        return $topic;
    }
}
