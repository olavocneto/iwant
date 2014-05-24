<?php

use Core\Application;

include __DIR__ . '/../vendor/autoload.php';

$app = new Application();

$app->initialize()
    ->run();

