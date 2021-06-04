<?php

namespace Codememory\Routing\Interfaces;

use Codememory\Routing\PathGenerator;

/**
 * Interface RouteResourcesInterface
 * @package Codememory\Routing\Interfaces
 *
 * @author  Codememory
 */
interface RouteResourcesInterface
{

    /**
     * @return PathGenerator
     */
    public function getPathGenerator(): PathGeneratorInterface;

    /**
     * @return callable|string
     */
    public function getAction(): callable|string;

    /**
     * @return array
     */
    public function getHeaders(): array;

    /**
     * @return string|null
     */
    public function getNamePrefix(): ?string;

    /**
     * @return array
     */
    public function getSoftware(): array;

    /**
     * @return ParametersInterface
     */
    public function getInputParameters(): ParametersInterface;

}