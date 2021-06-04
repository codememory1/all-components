<?php


namespace Codememory\Routing\App\Controllers;


use Codememory\Components\View\View;
use Codememory\FileSystem\File;
use Codememory\Routing\Controller\ControllerAbstract;

class TestController extends ControllerAbstract
{

    public function main(int $id, string $name) {
        $view = new View(new File());

        return $view->render('test')->makeOutput();
    }

}