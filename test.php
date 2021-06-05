<?php
ini_set('display_errors', 1);

/**
 *
 * =====================================================
 *
 * ТЕСТИРОВАНИЕ МЕТОДОВ МАРШРУТИЗАТОРА
 *
 * ====================================================
 *
 */

use Codememory\Routing\Router;
use Codememory\HttpFoundation\Request\Request;

require_once 'vendor/autoload.php';


Router::__constructStatic(new Request());
Router::initializingRoutesFromConfig();
Router::processAllRoutes();

