<?php

namespace Codememory\Routing;

use Codememory\Routing\Interfaces\ParametersInterface;
use Codememory\Routing\Interfaces\PathGeneratorInterface;
use Codememory\Support\Str;

/**
 * Class PathGenerator
 * @package Codememory\Routing
 *
 * @author  Codememory
 */
class PathGenerator implements PathGeneratorInterface
{

    /**
     * @var string
     */
    private string $routePath;

    /**
     * PathGenerator constructor.
     *
     * @param string $routePath
     */
    public function __construct(string $routePath)
    {

        $this->routePath = $routePath;

    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {

        return $this->routePath;

    }

    /**
     * @inheritDoc
     */
    public function getRegexPath(array $requiredParameters): string
    {

        $routePathParameters = new InputParameters($this->getPath());

        $this->checkRouteParametersInRequired($routePathParameters, $requiredParameters);

        return $this->generatingPathRegexFromRoutePath($requiredParameters);

    }

    /**
     * @param array $requiredParameters
     *
     * @return string
     */
    private function generatingPathRegexFromRoutePath(array $requiredParameters): string
    {

        $routePathQuote = preg_quote($this->getPath(), '/');

        foreach ($requiredParameters as $name => $regex) {
            $search = sprintf('\:%s', $name);
            $replace = sprintf('(?<%s>%s)', $name, $regex);

            Str::replace($routePathQuote, $search, $replace);
        }

        return sprintf('/^%s$/', $routePathQuote);

    }

    /**
     * @param ParametersInterface $routeParameters
     * @param array               $requiredParameters
     *
     * @return void
     */
    private function checkRouteParametersInRequired(ParametersInterface $routeParameters, array &$requiredParameters): void
    {

        foreach ($routeParameters->all() as $parameterName) {
            if (!array_key_exists($parameterName, $requiredParameters)) {
                $requiredParameters[$parameterName] = InputParameters::DEFAULT_PARAMETER_REGEX;
            }
        }

    }

}