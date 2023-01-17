<?php

namespace App\Controllers\API;

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
            'message' => 'Something went wrong.',
            'status' => 200,
            'data' => []
        ];

        if (isset($args['id'])) {
        } else {
            $this->topicModel->deleteAllTopics();
            $responseBody['success'] = true;
            $responseBody['message'] = 'All topics successfully deleted from database.';
        }

        return $response->withJson($responseBody);
    }
}