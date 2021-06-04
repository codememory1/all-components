<?php

namespace Codememory\Routing\Interfaces;

/**
 * Interface SoftwareLieHandlerInterface
 * @package Codememory\Routing\Interfaces
 *
 * @author  Codememory
 */
interface SoftwareLieHandlerInterface
{

    /**
     * @param callable $callback
     *
     * @return bool
     */
    public function process(callable $callback): bool;

}