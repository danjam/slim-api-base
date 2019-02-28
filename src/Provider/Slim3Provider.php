<?php

declare(strict_types=1);

namespace SlimApiBase\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use RKA\Middleware\IpAddress;
use Slim\App;
use Slim\Container as SlimContainer;
use SlimApiBase\Action\Example;

/**
 * Class Slim3Provider
 *
 * @package SlimApiBase\Provider
 */
class Slim3Provider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function register(Container $container)
    {
        $container[App::class] = function (SlimContainer $container): App {
            $app = new App($container);
            $app = $this->addMiddleware($app);
            $app = $this->addRoutes($app);

            return $app;
        };

        $this->addActions($container);
    }

    /**
     * Add your actions here
     *
     * @param Container $container
     */
    private function addActions(Container $container)
    {
        $container[Example::class] = function (): Example {
            return new Example();
        };
    }

    /**
     * Add your middleware here
     *
     * @param App $app
     *
     * @return App
     */
    private function addMiddleware(App $app): App
    {
        $app->add(new IpAddress());

        return $app;
    }

    /**
     * Add your routes here
     *
     * @param App $app
     *
     * @return App
     */
    private function addRoutes(App $app): App
    {
        $app->get('/', Example::class);

        return $app;
    }
}
