<?php

namespace App\Controllers\API;

use App\CustomExceptions\InvalidIdException;
use App\CustomExceptions\MissingTopicException;
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

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $responseBody = [
            'success' => false,
            'message' => 'Unexpected error.',
            'status' => 200,
            'data' => []
        ];

        $updatedTopic = $request->getParsedBody();
        $updatedTopic['id'] = $args['id'];

        try {
            $responseBody['data'] = $this->topicModel->getTopicById($updatedTopic['id']);
            $this->topicModel->updateTopicById($updatedTopic);
            $responseBody['success'] = true;
            $responseBody['message'] = 'Topic successfully updated in database.';
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
