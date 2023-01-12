<?php

namespace App\Models;

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

    public function filterLearningTopic(array $topics, bool $learning): array
    {
        if ($learning) {
            $topics = array_filter($topics, function ($topic) {
                return $topic['status'] === 'learning';
            });
        } elseif (!$learning) {
            $topics = array_filter($topics, function ($topic) {
                return $topic['status'] === 'not learning';
            });
        }
        return $topics;
    }
}
