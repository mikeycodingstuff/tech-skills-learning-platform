<?php

namespace App\Validators;

use App\CustomExceptions\InvalidTopicException;

class TopicValidator
{
    /**
     * Validates topic
     *
     * @param array $topic
     * @return boolean
     */
    public static function validateTopic(array $topic): bool
    {
        StringValidator::validateExistsAndLength($topic['name'], 120, 'name');
        self::validateLearning($topic['status']);
        StringValidator::validateExistsAndLength($topic['resources'], 10000, 'resources');

        return true;
    }

    /**
     * Validates learning status to match enum db values
     *
     * @param string $learningStatus
     * @return string
     */
    public static function validateLearning(string $learningStatus): string
    {
        if ($learningStatus !== 'learning' && $learningStatus !== 'not learning') {
            throw new InvalidTopicException('Learning status must be either "learning" or "not learning"');
        } else {
            return $learningStatus;
        }
    }
}
