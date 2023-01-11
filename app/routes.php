<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    // API routes
    $app->get('/api/topics', 'GetTopicsController');
};
