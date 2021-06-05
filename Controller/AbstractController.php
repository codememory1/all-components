<?php

namespace Codememory\Routing\Controller;

use Codememory\Container\ServiceProvider\Interfaces\ServiceProviderInterface;

/**
 * Class AbstractController
 * @package Codememory\Routing\Controller
 *
 * @author  Codememory
 */
abstract class AbstractController
{

    /**
     * @var ServiceProviderInterface
     */
    private ServiceProviderInterface $serviceProvider;

    /**
     * AbstractController constructor.
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