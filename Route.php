<?php

namespace Codememory\Routing;

use Codememory\HttpFoundation\Interfaces\RequestInterface;
use Codememory\HttpFoundation\Interfaces\ResponseInterface;
use Codememory\Routing\Interfaces\RouteInterface;
use Codememory\Routing\Interfaces\RouteResourcesInterface;

/**
 * Class Route
 * @package Codememory\Routing
 *
 * @author  Codememory
 */
class Route implements RouteInterface
{

    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * @var RouteResourcesInterface
     */
    private RouteResourcesInterface $resources;

    /**
     * @var array
     */
    private array $with = [];

    /**
     * @var string|null
     */
    private ?string $name = null;

    /**
     * Route constructor.
     *
     * @param RequestInterface        $request
     * @param ResponseInterface       $response
     * @param RouteResourcesInterface $resources
     */
    public function __construct(RequestInterface $request, ResponseInterface $response, RouteResourcesInterface $resources)
    {

        $this->request = $request;
        $this->response = $response;
        $this->resources = $resources;

    }

    /**
     * @inheritDoc
     */
    public function with(string $parameterName, string $regex = null): RouteInterface
    {

        $this->with[$parameterName] = $regex ?: Parameters::DEFAULT_PARAMETER_REGEX;

        return $this;

    }

    /**
     * @inheritDoc
     */
    public function name(string $name): RouteInterface
    {

        $this->name = $name;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {

        return $this->resources->getNamePrefix().$this->name;

    }


}