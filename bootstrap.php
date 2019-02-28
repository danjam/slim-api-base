<?php

declare(strict_types=1);

use Slim\Container;
use SlimApiBase\Provider\DoctrineProvider;
use SlimApiBase\Provider\MonologProvider;
use SlimApiBase\Provider\Slim3Provider;

if (!defined('ENV')) {
    define('ENV', 'dev');
}

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

require_once APP_ROOT . '/vendor/autoload.php';

$container = new Container(require APP_ROOT . '/config/settings.php');

$container
    ->register(new DoctrineProvider())
    ->register(new Slim3Provider())
    ->register(new MonologProvider());

return $container;
