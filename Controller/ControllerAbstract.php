<?php

namespace Codememory\Routing\Controller;

use Codememory\Container\ServiceProvider\Interfaces\ServiceProviderInterface;

/**
 * Class ControllerAbstract
 * @package Codememory\Routing\Controller
 *
 * @author  Codememory
 */
abstract class ControllerAbstract
{

    /**
     * @var ServiceProviderInterface
     */
    private ServiceProviderInterface $serviceProvider;

    /**
     * ControllerAbstract constructor.
     *
     * @param ServiceProviderInterface $serviceProvider
     */
    public function __construct(ServiceProviderInterface $serviceProvider)
    {

        $this->serviceProvider = $serviceProvider;

    }

    /**
     * @param string $provider
     *
     * @return object
     */
    protected function get(string $provider): object
    {

        return $this->serviceProvider->get($provider);

    }

    /**
     * @param string $property
     *
     * @return object
     */
    public function __get(string $property): object
    {

        return $this->get($property);

    }

}