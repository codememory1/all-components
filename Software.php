<?php

namespace Codememory\Routing;

use Codememory\HttpFoundation\Interfaces\RequestInterface;
use Codememory\HttpFoundation\Interfaces\ResponseInterface;
use Codememory\Routing\Exceptions\SoftwareWithoutParentException;
use Codememory\Routing\Exceptions\UndefinedSoftwareException;
use Codememory\Routing\Interfaces\SoftwareDataInterface;
use ReflectionClass;
use ReflectionException;

/**
 * Class Software
 * @package Codememory\Routing
 *
 * @author  Codememory
 */
class Software
{

    public const DELIMITER_CHAR_METHOD_NAME = ':';

    /**
     * @var Utils
     */
    private Utils $utils;

    /**
     * @var array
     */
    private array $software;

    /**
     * @var bool
     */
    private bool $softwareProcessingStatus = true;

    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * Software constructor.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param Utils             $utils
     * @param array             $software
     */
    public function __construct(RequestInterface $request, ResponseInterface $response, Utils $utils, array $software)
    {

        $this->request = $request;
        $this->response = $response;
        $this->utils = $utils;
        $this->software = $software;

    }

    /**
     * @return $this
     */
    public function make(): Software
    {

        $namespace = trim($this->utils->getBasicSettings()['softwareNamespace'], '\\') . '\\';

        $this->iterationSoftware(function (SoftwareDataInterface $softwareData) use ($namespace) {
            $fullNamespace = $namespace . $softwareData->getSoftwareName();

            if (!$this->checkParentSoftware($fullNamespace)) {
                throw new SoftwareWithoutParentException($fullNamespace);
            }

            $softwareLieHandler = new SoftwareLieHandler();

            $reflector = $this->getReflector($fullNamespace)->newInstanceArgs([
                $this->request,
                &$softwareLieHandler
            ]);
            $statusExecuteSoftware = call_user_func([$reflector, $softwareData->getSoftwareMethod()]);

            if (!$statusExecuteSoftware) {
                $this->response->setContent($softwareLieHandler->getProcess())->sendContent();
            }
        });

        return $this;

    }

    /**
     * @return bool
     */
    public function getSoftwareProcessingStatus(): bool
    {

        return $this->softwareProcessingStatus;

    }

    /**
     * @param string $softwareNamespace
     *
     * @return bool
     * @throws UndefinedSoftwareException
     * @throws ReflectionException
     */
    private function checkParentSoftware(string $softwareNamespace): bool
    {

        if ($this->existSoftware($softwareNamespace)) {
            $parent = $this->getReflector($softwareNamespace)->getParentClass();

            if (!$parent || $parent->getName() !== SoftwareAbstract::class) {
                return false;
            }

            return true;
        }

        return false;

    }

    /**
     * @param string $softwareNamespace
     *
     * @return ReflectionClass
     * @throws ReflectionException
     */
    private function getReflector(string $softwareNamespace): ReflectionClass
    {

        return new ReflectionClass($softwareNamespace);

    }

    /**
     * @param string $softwareNamespace
     *
     * @return bool
     * @throws UndefinedSoftwareException
     */
    private function existSoftware(string $softwareNamespace): bool
    {

        if (!class_exists($softwareNamespace)) {
            throw new UndefinedSoftwareException($softwareNamespace);
        }

        return true;

    }

    /**
     * @param callable $handler
     *
     * @return void
     */
    private function iterationSoftware(callable $handler): void
    {

        foreach ($this->software as $software) {
            call_user_func($handler, new SoftwareData($software));
        }

    }

}