<?php

namespace App\Controllers\API;

use App\Models\TopicsModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetTopicsController
{
    private TopicsModel $topicsModel;

    public function __construct(TopicsModel $topicsModel)
    {
        $this->topicsModel = $topicsModel;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $topics = $this->topicsModel->getAllTopics();
        $responseBody = [
            'message' => 'Topics successfully retrieved from db.',
            'status' => 200,
            'data' => $topics
        ];
        return $response->withJson($responseBody);
    }
}