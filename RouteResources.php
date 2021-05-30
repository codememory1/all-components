<?php

namespace Codememory\Routing;

use Closure;
use Codememory\Routing\Interfaces\ParametersInterface;
use Codememory\Routing\Interfaces\RouteResourcesInterface;
use JetBrains\PhpStorm\Pure;

/**
 * Class RouteResources
 * @package Codememory\Routing
 *
 * @author  Codememory
 */
class RouteResources implements RouteResourcesInterface
{

    /**
     * @var string
     */
    private string $path;

    /**
     * @var Closure|string
     */
    private Closure|string $action;

    /**
     * @var array
     */
    private array $headers;

    /**
     * @var string|null
     */
    private ?string $routeNamePrefix;

    /**
     * @var array
     */
    private array $software;

    /**
     * RouteResources constructor.
     *
     * @param string          $routePath
     * @param callable|string $routeAction
     * @param array           $routeHeaders
     * @param string|null     $routeNamePrefix
     * @param array           $routeSoftware
     */
    public function __construct(string $routePath, callable|string $routeAction, array $routeHeaders, ?string $routeNamePrefix, array $routeSoftware)
    {

        $this->path = $routePath;
        $this->action = $routeAction;
        $this->headers = $routeHeaders;
        $this->routeNamePrefix = $routeNamePrefix;
        $this->software = $routeSoftware;

    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {

        return $this->path;

    }

    /**
     * @inheritDoc
     */
    public function getAction(): callable|string
    {

        if (is_string($this->action)) {
            return str_replace('.', '\\', $this->action);
        }

        return $this->action;

    }

    /**
     * @inheritDoc
     */
    public function getHeaders(): array
    {

        return $this->headers;

    }

    /**
     * @inheritDoc
     */
    public function getNamePrefix(): ?string
    {

        return $this->routeNamePrefix;

    }

    /**
     * @inheritDoc
     */
    public function getSoftware(): array
    {

        return $this->software;

    }

    /**
     * @inheritDoc
     */
    #[Pure]
    public function getParameters(): ParametersInterface
    {

        return new Parameters($this->getPath());

    }

}