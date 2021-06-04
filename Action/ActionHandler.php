<?php

namespace Codememory\Routing\Action;

use Codememory\Container\DependencyInjection\DependencyInjection;
use Codememory\Container\DependencyInjection\Interfaces\DependencyInjectionInterface;
use Codememory\Routing\OutputParameters;
use Codememory\Routing\RouteResources;

/**
 * Class ActionHandler
 * @package Codememory\Routing
 *
 * @author  Codememory
 */
class ActionHandler
{

    public const DI_ID_PREFIX = '_route-action_';

    /**
     * @var OutputParameters
     */
    private OutputParameters $outputParameters;

    /**
     * @var RouteResources
     */
    private RouteResources $routeResources;

    /**
     * ActionHandler constructor.
     *
     * @param OutputParameters $outputParameters
     * @param RouteResources   $routeResources
     */
    public function __construct(OutputParameters $outputParameters, RouteResources $routeResources)
    {

        $this->outputParameters = $outputParameters;
        $this->routeResources = $routeResources;

    }

    /**
     * @return mixed
     */
    public function performAction(): mixed
    {

        $dependencyInjection = new DependencyInjection();

        if (is_string($this->routeResources->getAction())) {
            return $this->getAction($dependencyInjection, new ControllerAction());
        }

        return $this->getAction($dependencyInjection, new CallbackAction());

    }

    /**
     * @param DependencyInjectionInterface $dependencyInjection
     * @param ActionAbstract               $action
     *
     * @return mixed
     */
    private function getAction(DependencyInjectionInterface $dependencyInjection, ActionAbstract $action): mixed
    {

        return $action
            ->setAction($this->routeResources->getAction())
            ->setOutputParameters($this->outputParameters)
            ->call($dependencyInjection);

    }


}