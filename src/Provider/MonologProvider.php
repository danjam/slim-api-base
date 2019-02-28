<?php

declare(strict_types=1);

namespace SlimApiBase\Provider;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Container as SlimContainer;

/**
 * Class MonologProvider
 *
 * @package SlimApiBase\Provider
 */
class MonologProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $container)
    {
        $container[Logger::class] = function (SlimContainer $container): Logger {
            return (new Logger('API'))->pushHandler(
                new StreamHandler($container->get('settings')['logger']['api_log_path'])
            );
        };
    }
}
