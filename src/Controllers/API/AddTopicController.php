<?php

namespace App\Controllers\API;

use App\CustomExceptions\InvalidIdException;
use App\CustomExceptions\MissingTopicException;
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
        $newTopic = $request->getParsedBody();

        $responseBody = [
            'success' => false,
            'message' => 'Unexpected error.',
            'status' => 200,
            'data' => []
        ];

        try {
            $this->topicModel->addTopic($newTopic);
            $newTopicId = $this->topicModel->getLastTopicId();
            $responseBody['success'] = true;
            $responseBody['message'] = 'Topic successfully added to db.';
            $responseBody['data'] = $this->topicModel->getTopicById($newTopicId);
        } catch (InvalidIdException $e) {
            $responseBody['message'] = $e->getMessage();
            $responseBody['status'] = 404;
        } catch (MissingTopicException $e) {
            $responseBody['message'] = $e->getMessage();
            $responseBody['status'] = 404;
        }
        
        return $response->withJson($responseBody);
    }
}
