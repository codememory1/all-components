<?php

namespace Codememory\Routing\Interfaces;

/**
 * Interface RouteInterface
 * @package Codememory\Routing\Interfaces
 *
 * @author  Codememory
 */
interface RouteInterface
{

    /**
     * @param string      $parameterName
     * @param string|null $regex
     *
     * @return RouteInterface
     */
    public function with(string $parameterName, string $regex = null): RouteInterface;

    /**
     * @param string $name
     *
     * @return RouteInterface
     */
    public function name(string $name): RouteInterface;

    /**
     * @param string $namespaceSoftware
     *
     * @return RouteInterface
     */
    public function software(string $namespaceSoftware): RouteInterface;

}