<?php

namespace App\Factories;

use App\Controllers\API\GetTopicsController;
use Psr\Container\ContainerInterface;

class GetTopicsControllerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $topicsModel = $container->get('TopicsModel');
        return new GetTopicsController($topicsModel);
    }
}