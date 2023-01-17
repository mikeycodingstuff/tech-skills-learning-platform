<?php

namespace App\Controllers\API;

use App\CustomExceptions\InvalidIdException;
use App\Models\TopicModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UpdateTopicController
{
    private TopicModel $topicModel;

    public function __construct(TopicModel $topicModel)
    {
        $this->topicModel = $topicModel;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $responseBody = [
            'success' => false,
            'message' => 'Something went wrong.',
            'status' => 200,
            'data' => []
        ];

        $updatedTopic = $request->getParsedBody();

        try {
            $this->topicModel->updateTopicById($updatedTopic);
            $responseBody['success'] = true;
            $responseBody['message'] = 'Topic successfully updated in database.';
            $responseBody['data'] = $this->topicModel->getTopicById($updatedTopic['id']);
        } catch (InvalidIdException $e) {
            $responseBody['message'] = $e->getMessage();
            $responseBody['status'] = 404;
        }
        
        return $response->withJson($responseBody);
    }
}
