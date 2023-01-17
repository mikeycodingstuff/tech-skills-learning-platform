<?php

namespace App\Models;

use App\CustomExceptions\InvalidIdException;
use App\CustomExceptions\MissingTopicException;
use PDO;

class TopicModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Gets all topics from database
     *
     * @return array
     */
    public function getAllTopics(): array
    {
        $query = $this->db->prepare(
            "SELECT `id`, `topic_name`, `status`, `resources`, `deleted`
                FROM `topics`
                    WHERE `deleted` = '0';"
        );
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
     * Adds a new topic to database
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
                );"
        );

        $query->bindParam(':topic_name', $topic['topic_name']);
        $query->bindParam(':status', $topic['status']);
        $query->bindParam(':resources', $topic['resources']);
        $query->bindParam(':deleted', $topic['deleted']);
        return $query->execute();
    }

    /**
     * Gets a topic given an Id. Throws an error if Id is not in database
     *
     * @param integer $id
     * @return void
     */
    public function getTopicById(int $id)
    {
        $query = $this->db->prepare(
            "SELECT `id`, `topic_name`, `status`, `resources`, `deleted`
                FROM `topics`
                    WHERE `id` = :id;"
        );
        $query->bindParam(':id', $id);
        $query->execute();
        $result = $query->fetch();

        if (!$result) {
            throw new InvalidIdException('Invalid Id');
        }

        if ($result['deleted'] === '1') {
            throw new MissingTopicException('Topic does not exist');
        }
        
        return $result;
    }

    /**
     * Marks all topics as deleted in database
     *
     * @return void
     */
    public function deleteAllTopics()
    {
        $query = $this->db->prepare(
            "UPDATE `topics`
                SET `deleted` = '1';"
        );
        return $query->execute();
    }
    
    /**
     * Given an id, marks the topic as deleted in database
     *
     * @param integer $id
     * @return void
     */
    public function deleteTopicById(int $id)
    {
        $query = $this->db->prepare(
            "UPDATE `topics`
                SET `deleted` = '1'
                    WHERE `id` = :id;"
        );
        $query->bindParam(':id', $id);
        $result = $query->execute();

        if (!$result) {
            throw new InvalidIdException('Invalid Id');
        }

        return $result;
    }

    /**
     * Updates a topic's name, status and resources
     *
     * @param array $topic
     * @return void
     */
    public function updateTopicById(array $topic)
    {
        $query = $this->db->prepare(
            "UPDATE `topics`
                SET `topic_name` = :topic_name,
                    `status` = :status,
                    `resources` = :resources
                        WHERE `id` = :id"
        );
        $query->bindParam(':id', $topic['id']);
        $query->bindParam(':topic_name', $topic['topic_name']);
        $query->bindParam(':status', $topic['status']);
        $query->bindParam(':resources', $topic['resources']);
        $result = $query->execute();

        if (!$result) {
            throw new InvalidIdException('Invalid Id');
        }

        return $result;
    }
}
