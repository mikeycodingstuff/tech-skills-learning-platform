<?php
declare(strict_types=1);

use App\Factories\LoggerFactory;
use App\Factories\PDOFactory;
use App\Factories\RendererFactory;
use App\Factories\TopicsModelFactory;
use App\Factories\GetTopicsControllerFactory;
use DI\ContainerBuilder;
use Psr\Log\LoggerInterface;
use Slim\Views\PhpRenderer;

return function (ContainerBuilder $containerBuilder) {
    $container = [];
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => true, // should be set to false in production
            'db' => [
                'host' => 'mysql:host=DB;',
                'name' => 'dbname=tech_skills',
                'user' => 'root',
                'password' => 'password'
            ]
        ]
    ]);

    $container[LoggerInterface::class] = DI\factory(LoggerFactory::class);
    $container[PhpRenderer::class] = DI\factory(RendererFactory::class);
    
    // db connection
    $container[db::class] = DI\factory(PDOFactory::class);

    // factories
    $container['TopicsModel'] = DI\Factory(TopicsModelFactory::class);
    $container['GetTopicsController'] = DI\Factory(GetTopicsControllerFactory::class);

    $containerBuilder->addDefinitions($container);
};
