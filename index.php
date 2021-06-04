<?php


/**
 *
 * =====================================================
 *
 * ТЕСТИРОВАНИЕ МЕТОДОВ МАРШРУТИЗАТОРА
 *
 * ====================================================
 *
 */

ini_set('display_errors', 1);

use Codememory\Routing\Router;
use Codememory\HttpFoundation\Request\Request;
use Codememory\HttpFoundation\ControlHttpStatus\ControlResponseCode;

require_once 'vendor/autoload.php';

$c = new ControlResponseCode(new \Codememory\HttpFoundation\Response\Response(new \Codememory\HttpFoundation\Client\Header\Header()));


Router::__constructStatic(new Request());
Router::initializingRoutesFromConfig();
Router::processAllRoutes();
$c->trackResponseStatus();
