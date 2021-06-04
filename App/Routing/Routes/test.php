<?php

use Codememory\Routing\Router;

Router::get('Router/:id', function (string $id) {
    echo $id;
})->with('id', '[0-9]+');