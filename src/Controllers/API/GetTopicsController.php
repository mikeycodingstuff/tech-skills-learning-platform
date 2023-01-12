<?php

namespace App\Controllers\API;

use App\Models\TopicModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetTopicsController
{
    private TopicModel $topicModel;

    public function __construct(TopicModel $topicModel)
    {
        $this->topicModel = $topicModel;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $getData = $request->getQueryParams();
        $learning = filter_var(($getData['learning']), FILTER_VALIDATE_BOOLEAN);

        $topics = $this->topicModel->getAllTopics();

        if (isset($getData['learning'])) {
            $topics = $this->topicModel->filterLearningTopic($topics, $learning);
        }

        $responseBody = [
            'message' => 'Topics successfully retrieved from db.',
            'status' => 200,
            'data' => $topics
        ];
        
        return $response->withJson($responseBody);
    }
}
