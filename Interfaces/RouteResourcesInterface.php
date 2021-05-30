<?php

namespace Codememory\Routing\Interfaces;

/**
 * Interface RouteResourcesInterface
 * @package Codememory\Routing\Interfaces
 *
 * @author  Codememory
 */
interface RouteResourcesInterface
{

    /**
     * @return string
     */
    public function getPath(): string;

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
    public function getParameters(): ParametersInterface;

}