<?php

namespace Codememory\Routing\Interfaces;

/**
 * Interface SoftwareDataInterface
 * @package Codememory\Routing\Interfaces
 *
 * @author  Codememory
 */
interface SoftwareDataInterface
{

    /**
     * @return string
     */
    public function getSoftwareName(): string;

    /**
     * @return string|null
     */
    public function getSoftwareMethod(): ?string;

}