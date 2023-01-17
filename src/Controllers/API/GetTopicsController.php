<?php

namespace App\Controllers\API;

use App\CustomExceptions\InvalidIdException;
use App\CustomExceptions\MissingTopicException;
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
                $responseBody['data'] = $this->topicModel->getTopicById($args['id']);
                $responseBody['success'] = true;
                $responseBody['message'] = 'Topic successfully retrieved from database.';
            } catch (InvalidIdException $e) {
                $responseBody['message'] = $e->getMessage();
                $responseBody['status'] = 404;
            } catch (MissingTopicException $e) {
                $responseBody['message'] = $e->getMessage();
                $responseBody['status'] = 404;
            }
        } else {
            $responseBody['data'] = $this->topicModel->getAllTopics();
            $responseBody['success'] = true;
            $responseBody['message'] = 'All topics successfully retrieved from database.';
        
            if (isset($getData['learning'])) {
                $learningStatus = filter_var(($getData['learning']), FILTER_VALIDATE_BOOLEAN);
                $responseBody['data'] = $this->topicModel->filterLearningTopic($responseBody['data'], $learningStatus);
            }
        }
        
        return $response->withJson($responseBody);
    }
}
