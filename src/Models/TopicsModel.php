<?php

namespace App\Models;

class TopicsModel
{
    private $db;

    public function __construct(\PDO $db)
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
}
