<?php

use Codememory\Routing\Router;
use Codememory\Routing\RouteRedirection;



Router::get('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+')->name('route1');
Router::get('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+')->name('route2');
Router::get('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+')->name('route3');
Router::get('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+')->name('route4');
Router::get('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+')->name('route5');
Router::get('/Router/users/:userid/:lastname', function () {
//    echo $id;
})->with('userid', '[0-9]+')->with('lastname', '[a-zA-Z]+')->name('api');
Router::fetch('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+')->name('route6');
Router::get('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+')->name('route7');
Router::post('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+')->name('route8');
Router::get('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+')->name('route9');
Router::post('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+')->name('route10');
Router::put('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+')->name('route11');
