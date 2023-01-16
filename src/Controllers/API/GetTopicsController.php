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

    public function __invoke(RequestInterface $request, ResponseInterface $response,  array $args): ResponseInterface
    {
        $getData = $request->getQueryParams();
        if (isset($args['id'])) {
            $id = $args['id'];
            $data = $this->topicModel->getTopicById($id);
        } else {
            $data = $this->topicModel->getAllTopics();
            
            if (isset($getData['learning'])) {
                $learningStatus = filter_var(($getData['learning']), FILTER_VALIDATE_BOOLEAN);
                $data = $this->topicModel->filterLearningTopic($data, $learningStatus);
            }
        }

        $responseBody = [
            'message' => 'Topics successfully retrieved from db.',
            'status' => 200,
            'data' => $data
        ];
        
        return $response->withJson($responseBody);
    }
}
