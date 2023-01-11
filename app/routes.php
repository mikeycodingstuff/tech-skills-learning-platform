<?php
declare(strict_types=1);

use App\Controllers\CoursesAPIController;
use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $container = $app->getContainer();

    //demo code - two ways of linking urls to functionality, either via anon function or linking to a controller

    $app->get('/', function ($request, $response, $args) use ($container) {
        $renderer = $container->get(PhpRenderer::class);
        return $renderer->render($response, "index.php", $args);
    });

    $app->get('/courses', CoursesAPIController::class);

    $app->get('/topics', function ($request, $response, $args) use ($container) {
        $topicsModel = $container->get('TopicsModel');
        $topics = $topicsModel->getAllTopics();
        $responseBody = [
            'message' => 'Topics successfully retrieved from db.',
            'status' => 200,
            'data' => $topics
        ];
        return $response->withJson($responseBody);
    });

};
