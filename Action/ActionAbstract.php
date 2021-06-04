<?php

namespace Codememory\Routing\Action;

use Codememory\Container\DependencyInjection\Interfaces\DependencyInjectionInterface;
use Codememory\Routing\OutputParameters;
use Codememory\Support\Str;
use Exception;

/**
 * Class ActionAbstract
 * @package Codememory\Routing\Action
 *
 * @author  Codememory
 */
abstract class ActionAbstract
{

    /**
     * @var mixed
     */
    protected mixed $action = null;

    /**
     * @var OutputParameters|null
     */
    protected ?OutputParameters $outputParameters = null;

    /**
     * @param mixed $action
     *
     * @return ActionAbstract
     */
    public function setAction(mixed $action): ActionAbstract
    {

        $this->action = $action;

        return $this;

    }

    /**
     * @param OutputParameters $outputParameters
     *
     * @return $this
     */
    public function setOutputParameters(OutputParameters $outputParameters): ActionAbstract
    {

        $this->outputParameters = $outputParameters;

        return $this;

    }

    /**
     * @param string|null $name
     *
     * @return string
     * @throws Exception
     */
    public function composeAndGetDependencyId(?string $name = null): string
    {

        return sprintf('%s%s', ActionHandler::DI_ID_PREFIX, $name ?: Str::random(36));

    }

    /**
     * @param DependencyInjectionInterface $dependencyInjection
     *
     * @return mixed
     */
    abstract public function call(DependencyInjectionInterface $dependencyInjection): mixed;

}