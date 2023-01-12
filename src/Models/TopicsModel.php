<?php

namespace App\Models;

use PDO;

class TopicsModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllTopics(): array
    {
        $query = $this->db->prepare(
            "SELECT `id`, `topic_name`, `status`, `resources`, `deleted`
                FROM `topics`;
        ");
        $query->execute();
        return $query->fetchAll();
    }

    public function filterLearningTopic(array $topics): array
    {
        $topics = array_filter($topics, function ($topic) {
            return $topic['status'] === 'learning';
        });
        return $topics;
    }

    public function filterNotLearningTopic(array $topics): array
    {
        $topics = array_filter($topics, function ($topic) {
            return $topic['status'] === 'not learning';
        });
        return $topics;
    }
}
