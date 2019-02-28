<?php

declare(strict_types=1);

use Slim\App;
use Slim\Container;

/** @var Container $container */
$container = require_once __DIR__ . '/../bootstrap.php';

/** @var App $app */
$app = $container->get(App::class);
$app->run();
