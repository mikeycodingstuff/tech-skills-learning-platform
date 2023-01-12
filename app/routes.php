<?php
declare(strict_types=1);

use App\Controllers\API\GetTopicsController;
use Slim\App;

return function (App $app) {
    // API routes
    $app->get('/api/topics', GetTopicsController::class);
};
