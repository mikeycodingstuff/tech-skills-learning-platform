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
        $getData = $request->getQueryParams();
        $topics = $this->topicsModel->getAllTopics();

        if (isset($getData['learning']) && $getData['learning'] === 'true') {
            $topics = $this->topicsModel->filterLearningTopic($topics);
        } elseif (isset($getData['learning']) && $getData['learning'] === 'false') {
            $topics = $this->topicsModel->filterNotLearningTopic($topics);
        }

        $responseBody = [
            'message' => 'Topics successfully retrieved from db.',
            'status' => 200,
            'data' => $topics
        ];
        
        return $response->withJson($responseBody);
    }
}
