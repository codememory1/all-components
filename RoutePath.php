<?php

namespace Codememory\Routing;

/**
 * Class RoutePath
 * @package Codememory\Routing
 *
 * @author  Codememory
 */
class RoutePath
{

    /**
     * @var string
     */
    private string $routePath;

    /**
     * RoutePath constructor.
     *
     * @param string $routePath
     */
    public function __construct(string $routePath)
    {

        $this->routePath = $routePath;

    }

}