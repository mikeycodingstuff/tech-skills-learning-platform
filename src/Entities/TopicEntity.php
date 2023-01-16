<?php

namespace App\Entities;

class TopicEntity
{
    protected $id;
    protected $topic_name;
    protected $status;
    protected $resources;
    protected $deleted;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of topic_name
     */ 
    public function getTopicName()
    {
        return $this->topic_name;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of resources
     */ 
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * Get the value of deleted
     */ 
    public function getDeleted()
    {
        return $this->deleted;
    }
}