<?php

use Symfony\Component\Console\Application;
use Codememory\Routing\Commands\RouteListCommand;
use Codememory\Routing\Commands\MakeSoftwareCommand;

const ROOT = __DIR__;

require_once ROOT . '/vendor/autoload.php';

$app = new Application();

$app->add(new RouteListCommand());
$app->add(new MakeSoftwareCommand());

$app->run();