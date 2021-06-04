<?php

namespace Codememory\Routing\Interfaces;

/**
 * Interface PathGeneratorInterface
 * @package Codememory\Routing\Interfaces
 *
 * @author  Codememory
 */
interface PathGeneratorInterface
{

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @param array $requiredParameters
     *
     * @return string
     */
    public function getRegexPath(array $requiredParameters): string;

}