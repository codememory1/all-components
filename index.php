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
use Codememory\Routing\RoutePath;

require_once 'vendor/autoload.php';

$request = new Request();
$parameters = new RoutePath('Router/:id/:name');

try {
    Router::__constructStatic($request);



    Router::get('Router/:id/:name', 'App.Controller.MainController#main')->name('main1');
    Router::nameGroup('admin.', function () {
       Router::nameGroup('users.', function () {
           Router::get('Router/:id/:name', 'App.Controller.MainController#main2')->name('main2');
       });

       Router::post('Router/:id/:name', 'App.Controller.MainController#main3')->name('main3');
    });
    Router::get('Router/:id/:name', 'App.Controller.MainController#main')->name('main4');

    foreach (Router::allRoutes() as $route) {
        echo $route->getName().'<br>';
    }
    
} catch (ErrorException $e) {
    die($e->getMessage());
}