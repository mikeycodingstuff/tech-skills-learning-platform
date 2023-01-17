<?php
declare(strict_types=1);

use App\Controllers\API\GetTopicsController;
use App\Controllers\API\AddTopicController;
use App\Controllers\API\DeleteTopicsController;
use App\Controllers\API\UpdateTopicsController;
use Slim\App;

return function (App $app) {
    // API routes
    $app->get('/api/topics[/{id}]', GetTopicsController::class);
    $app->post('/api/topics', AddTopicController::class);
    $app->delete('/api/topics[/{id}]', DeleteTopicsController::class);
    $app->put('/api/topics/{id}', UpdateTopicsController::class);
};
