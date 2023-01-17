<?php

namespace App\Controllers\API;

use App\CustomExceptions\InvalidIdException;
use App\Models\TopicModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class DeleteTopicsController
{
    private TopicModel $topicModel;

    public function __construct(TopicModel $topicModel)
    {
        $this->topicModel = $topicModel;        
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $responseBody = [
            'success' => false,
            'message' => 'Unexpected error.',
            'status' => 200,
            'data' => []
        ];

        if (isset($args['id'])) {
            try {
                $this->topicModel->deleteTopicById($args['id']);
                $responseBody['success'] = true;
                $responseBody['message'] = 'Topic successfully deleted from database.';
            } catch (InvalidIdException $e) {
                $responseBody['message'] = $e->getMessage();
                $responseBody['status'] = 404;
            }
        } else {
            $this->topicModel->deleteAllTopics();
            $responseBody['success'] = true;
            $responseBody['message'] = 'All topics successfully deleted from database.';
        }

        return $response->withJson($responseBody);
    }
}