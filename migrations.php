<?php

declare(strict_types=1);

$container = require __DIR__ . '/bootstrap.php';

return $container->get('settings')['doctrine']['migrations'];
