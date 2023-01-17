<?php

namespace App\Models;

use App\Entities\TopicEntity;
use App\CustomExceptions\InvalidIdException;
use PDO;

class TopicModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Gets all topics from the database
     *
     * @return array
     */
    public function getAllTopics(): array
    {
        $query = $this->db->prepare(
            "SELECT `id`, `topic_name`, `status`, `resources`, `deleted`
                FROM `topics`;
        ");
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Filters topics based on learning status
     *
     * @param array $topics
     * @param boolean $learning
     * @return array returns array of topics with learning status or not learning status
     */
    public function filterLearningTopic(array $topics, bool $learningStatus): array
    {
        if ($learningStatus) {
            $topics = array_filter($topics, function ($topic) {
                return $topic['status'] === 'learning';
            });
        } elseif (!$learningStatus) {
            $topics = array_filter($topics, function ($topic) {
                return $topic['status'] === 'not learning';
            });
        }
        return $topics;
    }

    /**
     * Adds a new topic to the database
     *
     * @param array $topic
     * @return void
     */
    public function addTopic(array $topic)
    {
        $query = $this->db->prepare(
            "INSERT INTO `topics` (
                `topic_name`, `status`, `resources`, `deleted`
                )
                VALUES (
                :topic_name, :status, :resources, :deleted
                );
        ");

        $query->bindParam(':topic_name', $topic['topic_name']);
        $query->bindParam(':status', $topic['status']);
        $query->bindParam(':resources', $topic['resources']);
        $query->bindParam(':deleted', $topic['deleted']);
        return $query->execute();
    }

    public function getTopicById(int $id)
    {
        $query = $this->db->prepare(
            "SELECT `id`, `topic_name`, `status`, `resources`, `deleted`
                FROM `topics`
                    WHERE `id` = :id;
        ");
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetchAll();
        if (!$result) {
            throw new InvalidIdException();
        }
        return $result;
    }
}
