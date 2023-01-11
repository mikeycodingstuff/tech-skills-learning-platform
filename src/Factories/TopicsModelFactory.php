<?php

namespace App\Factories;

use App\Models\TopicsModel;
use Psr\Container\ContainerInterface;

class TopicsModelFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $db = $container->get('db');
        return new TopicsModel($db);
    }
}
