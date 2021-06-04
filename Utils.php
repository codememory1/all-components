<?php

namespace Codememory\Routing;

use Codememory\Components\Configuration\Config;
use Codememory\Components\Configuration\Exceptions\ConfigNotFoundException;
use Codememory\Components\Configuration\Interfaces\ConfigInterface;
use Codememory\Components\Environment\Exceptions\EnvironmentVariableNotFoundException;
use Codememory\Components\Environment\Exceptions\IncorrectPathToEnviException;
use Codememory\Components\Environment\Exceptions\ParsingErrorException;
use Codememory\Components\Environment\Exceptions\VariableParsingErrorException;
use Codememory\Components\GlobalConfig\GlobalConfig;
use Codememory\FileSystem\Interfaces\FileInterface;
use Codememory\Routing\Exceptions\IncorrectControllerException;
use Codememory\Routing\Exceptions\InvalidControllerMethodException;
use Codememory\Support\Arr;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class Utils
 * @package Codememory\Routing
 *
 * @author  Codememory
 */
class Utils
{

    /**
     * @var ConfigInterface
     */
    private ConfigInterface $config;

    /**
     * Utils constructor.
     *
     * @param FileInterface $filesystem
     *
     * @throws ConfigNotFoundException
     * @throws EnvironmentVariableNotFoundException
     * @throws IncorrectPathToEnviException
     * @throws ParsingErrorException
     * @throws VariableParsingErrorException
     */
    public function __construct(FileInterface $filesystem)
    {

        $config = new Config($filesystem);

        $this->config = $config->open(GlobalConfig::get('routing.configName'), $this->getDefaultConfig());

    }

    /**
     * @return array
     */
    public function getBasicSettings(): array
    {

        return $this->config->get('_settings');

    }

    /**
     * @return array
     * @throws IncorrectControllerException
     * @throws InvalidControllerMethodException
     */
    public function getRoutes(): array
    {

        $routes = [];

        foreach ($this->config->get('_routes') as $routeName => $routeData) {
            $path = $routeData['path'] ?? '/';
            $requestMethod = $routeData['method'] ?? 'GET';
            $controller = $this->existAndGetController(Arr::set($routeData)::get('class.controller'));
            $method = $this->existAndGetControllerMethod($controller, Arr::set($routeData)::get('class.method'));
            $parameters = $routeData['parameters'] ?? [];
            $software = $routeData['software'] ?? [];
            $schemes = $routeData['schemes'] ?? [];

            $routes[$routeName] = $this->getRouteStructure($path, $requestMethod, $controller, $method, $parameters, $software, $schemes);
        }

        return $routes;

    }

    /**
     * @param string $routeName
     *
     * @return array
     * @throws IncorrectControllerException
     * @throws InvalidControllerMethodException
     */
    public function getRouteData(string $routeName): array
    {

        return $this->getRoutes()[$routeName] ?? [];

    }

    /**
     * @param string $path
     * @param string $requestMethod
     * @param string $controller
     * @param string $method
     * @param array  $parameters
     * @param array  $software
     * @param array  $schemes
     *
     * @return array
     */
    #[ArrayShape(['path' => "string", 'method' => "string", 'class' => "string[]", 'parameters' => "array", 'software' => "array", 'schemes' => "array"])]
    public function getRouteStructure(string $path, string $requestMethod, string $controller, string $method, array $parameters, array $software, array $schemes): array
    {

        return [
            'path'       => $path,
            'method'     => $requestMethod,
            'class'      => [
                'controller' => $controller,
                'method'     => $method,
            ],
            'parameters' => $parameters,
            'software'   => $software,
            'schemes'    => $schemes
        ];

    }

    /**
     * @param string|null $controller
     *
     * @return string
     * @throws IncorrectControllerException
     */
    public function existAndGetController(?string $controller): string
    {

        if (empty($controller) || !class_exists($controller)) {
            throw new IncorrectControllerException($controller);
        }

        return $controller;

    }

    /**
     * @param string|null $controller
     * @param string|null $method
     *
     * @return string
     * @throws IncorrectControllerException
     * @throws InvalidControllerMethodException
     */
    public function existAndGetControllerMethod(?string $controller, ?string $method): string
    {

        if ($this->existAndGetController($controller) && !empty($method) && method_exists($controller, $method)) {
            return $method;
        }

        throw new InvalidControllerMethodException($controller, $method);

    }

    /**
     * @return array
     */
    #[ArrayShape(['_settings' => "mixed", '_routes' => "array"])]
    private function getDefaultConfig(): array
    {

        return [
            '_settings' => GlobalConfig::get('routing.settings'),
            '_routes'   => []
        ];

    }

}