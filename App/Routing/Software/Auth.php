<?php

namespace Codememory\Routing\App\Routing\Software;

use Codememory\Routing\SoftwareAbstract;

/**
 * Class Auth
 * @package Codememory\Routing\App\Routing\Software
 *
 * @author Codememory
 */
class Auth extends SoftwareAbstract
{

    public function api(): bool
    {

        return true;

    }

}