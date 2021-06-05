<?php


namespace Codememory\Routing\App\Controllers;


use Codememory\Components\View\View;
use Codememory\FileSystem\File;
use Codememory\Routing\Controller\AbstractController;
use Codememory\Routing\Router;
use Codememory\Routing\RouteRedirection;

class TestController extends AbstractController
{

    public function main(int $id, string $name) {
        $view = new View(new File());

        $r = new RouteRedirection(Router::getRouteByName('apci'), ['userid' => 10, 'lastname' => 'Kostyn']);

//        return $view->render('test')->makeOutput();
    }

}