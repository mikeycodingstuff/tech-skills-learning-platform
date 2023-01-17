<?php

namespace App\Controllers\API;

use App\CustomExceptions\InvalidIdException;
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

        $responseBody = [
            'success' => false,
            'message' => 'Something went wrong.',
            'status' => 200,
            'data' => []
        ];
        
        if (isset($args['id'])) {
            try {
                $data = $this->topicModel->getTopicById($args['id']);
                $responseBody = [
                    'success' => true,
                    'message' => 'Topic successfully retrieved from database.',
                    'status' => 200,
                    'data' => $data
                ];
            } catch (InvalidIdException $e) {
                $responseBody['message'] = 'Invalid Id';
                $responseBody['status'] = 404;
            }
        } else {
            $allTopics = $this->topicModel->getAllTopics();

            $responseBody = [
                'success' => true,
                'message' => 'Topics successfully retrieved from database.',
                'status' => 200,
                'data' => $allTopics
            ];
            
            if (isset($getData['learning'])) {
                $learningStatus = filter_var(($getData['learning']), FILTER_VALIDATE_BOOLEAN);
                $filteredTopics = $this->topicModel->filterLearningTopic($allTopics, $learningStatus);
                $responseBody['data'] = $filteredTopics;
            }
        }
        
        return $response->withJson($responseBody);
    }
}
