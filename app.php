<?php

use Symfony\Component\Console\Application;
use Codememory\Routing\Commands\RouteListCommand;

const ROOT = __DIR__;

require_once ROOT . '/vendor/autoload.php';

$app = new Application();

$app->add(new RouteListCommand());

$app->run();