<?php
declare(strict_types=1);

use App\Controllers\API\AddTopicController;
use App\Controllers\API\GetTopicsController;
use Slim\App;

return function (App $app) {
    // API routes
    $app->get('/api/topics[/{id}]', GetTopicsController::class);
    $app->post('/api/topics', AddTopicController::class);
};
