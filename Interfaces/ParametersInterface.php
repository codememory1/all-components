<?php

namespace Codememory\Routing\Interfaces;

/**
 * Interface ParametersInterface
 * @package Codememory\Routing\Interfaces
 *
 * @author  Codememory
 */
interface ParametersInterface
{

    /**
     * @return array
     */
    public function all(): array;

    /**
     * @return string|null
     */
    public function getFirstParameter(): ?string;

    /**
     * @return string|null
     */
    public function getLastParameter(): ?string;

}