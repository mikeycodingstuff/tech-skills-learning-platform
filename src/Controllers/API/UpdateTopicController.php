<?php

namespace App\Controllers\API;

use App\Models\TopicModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AddTopicController
{
    private TopicModel $topicModel;

    public function __construct(TopicModel $topicModel)
    {
        $this->topicModel = $topicModel;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $responseBody = [
            'message' => 'Topic successfully updated in db.',
            'status' => 200,
            'data' => []
        ];
        
        return $response->withJson($responseBody);
    }
}
