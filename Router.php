<?php

namespace Codememory\Routing;

use Codememory\Routing\Interfaces\RouteInterface;
use Codememory\Routing\Interfaces\RouterInterface;
use Codememory\Routing\Traits\ConstructStaticTrait;
use Codememory\Support\Str;
use JetBrains\PhpStorm\Pure;

/**
 * Class Router
 * @package Codememory\Routing
 *
 * @author  Codememory
 */
class Router implements RouterInterface
{

    private const INPUT_NAME_WITH_METHOD = '_method';

    use ConstructStaticTrait;

    /**
     * @var array
     */
    private static array $routes = [];

    /**
     * @var string|null
     */
    private static ?string $routePathPrefix = null;

    /**
     * @var string|null
     */
    private static ?string $routeNamePrefix = null;

    /**
     * @var array
     */
    private static array $software = [];

    /**
     * @inheritDoc
     */
    public static function get(string $path, callable|string $action): RouteInterface
    {

        return self::routeCollector($path, ['GET'], $action);

    }

    /**
     * @inheritDoc
     */
    public static function post(string $path, callable|string $action): RouteInterface
    {

        return self::routeCollector($path, ['POST'], $action);

    }

    /**
     * @inheritDoc
     */
    public static function any(string $path, callable|string $action): RouteInterface
    {

        return self::routeCollector($path, ['GET', 'POST', 'FETCH', 'PUT'], $action);

    }

    /**
     * @inheritDoc
     */
    public static function fetch(string $path, callable|string $action): RouteInterface
    {

        return self::routeCollector($path, ['FETCH'], $action, ['X-Requested-With' => 'XMLHttpRequest']);

    }

    /**
     * @inheritDoc
     */
    public static function put(string $path, callable|string $action): RouteInterface
    {

        return self::routeCollector($path, ['PUT'], $action);

    }

    /**
     * @inheritDoc
     */
    public static function group(string $pathPrefix, callable $callback): RouterInterface
    {

        return self::prefixHandler($pathPrefix, $callback, 'routePathPrefix');

    }

    /**
     * @inheritDoc
     */
    public static function nameGroup(string $namePrefix, callable $callback): RouterInterface
    {

        return self::prefixHandler($namePrefix, $callback, 'routeNamePrefix');

    }

    /**
     * @inheritDoc
     */
    public static function softwareGroup(array $software, callable $callback): RouterInterface
    {

        self::$software = array_merge(self::$software, $software);

        call_user_func($callback);

        self::$software = [];

        return new self();

    }

    /**
     * @inheritDoc
     */
    public static function routeExist(string $routeName): bool
    {

        foreach (self::allRoutes() as $route) {
            if ($route->getName() === $routeName) {
                return true;
            }
        }

        return false;

    }

    /**
     * @inheritDoc
     */
    public static function allRoutes(): array
    {

        $routesWithoutHttpMethod = [];

        foreach (self::$routes as $routes) {
            foreach ($routes as $route) {
                $routesWithoutHttpMethod[] = $route;
            }
        }

        return $routesWithoutHttpMethod;

    }

    /**
     * @return void
     * @throws Exceptions\ConstructorNotInitializedException
     */
    public static function processAllRoutes(): void
    {

        self::checkConstructorInitialization();

    }

    /**
     * @param string $routePath
     *
     * @return string
     */
    #[Pure]
    public static function collectAndGetRoutePath(string $routePath): string
    {

        $prefix = trim(self::$routePathPrefix, '/') . '/';

        return self::$request->url->getUrl($prefix . $routePath);

    }

    /**
     * @param string          $path
     * @param array           $methods
     * @param callable|string $action
     * @param array           $headers
     *
     * @return RouteInterface
     */
    private static function routeCollector(string $path, array $methods, callable|string $action, array $headers = []): RouteInterface
    {

        $methods = array_map(fn (string $method) => Str::toUppercase($method), $methods);
        $route = new Route(self::$request, self::$response, new RouteResources(
            self::collectAndGetRoutePath($path),
            $action,
            $headers,
            self::$routeNamePrefix,
            self::$software,
        ));

        foreach ($methods as $method) {
            self::$routes[$method][] = $route;
        }

        return $route;

    }

    /**
     * @param string   $prefix
     * @param callable $callback
     * @param string   $propertyForPrefix
     *
     * @return RouterInterface
     */
    private static function prefixHandler(string $prefix, callable $callback, string $propertyForPrefix): RouterInterface
    {

        self::$$propertyForPrefix .= $prefix;

        call_user_func($callback);

        self::$$propertyForPrefix = null;

        return new self();

    }

    /**
     * @return string
     */
    private static function getRequestMethod(): string
    {

        $requestMethod = self::$request->getMethod();
        $methodFromFormField = self::$request->post()->get(self::INPUT_NAME_WITH_METHOD);

        if (null !== $methodFromFormField) {
            $methodFromFormField = Str::toUppercase($methodFromFormField);
        }

        if ('POST' === $requestMethod && null !== $methodFromFormField) {
            return $methodFromFormField;
        }

        return $requestMethod;

    }

}