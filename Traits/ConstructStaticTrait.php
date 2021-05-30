<?php

namespace Codememory\Routing\Traits;

use Codememory\HttpFoundation\Interfaces\RequestInterface;
use Codememory\HttpFoundation\Interfaces\ResponseInterface;
use Codememory\HttpFoundation\Response\Response;
use Codememory\Routing\Exceptions\ConstructorNotInitializedException;
use Codememory\Routing\Exceptions\SingleConstructorInitializationException;

/**
 * Trait ConstructStaticTrait
 * @package Codememory\Routing\Traits
 *
 * @author  Codememory
 */
trait ConstructStaticTrait
{

    /**
     * @var bool
     */
    private static bool $constructorInitialization = false;

    /**
     * @var RequestInterface
     */
    private static RequestInterface $request;

    /**
     * @var ResponseInterface
     */
    private static ResponseInterface $response;

    /**
     * @param RequestInterface $request
     *
     * @throws SingleConstructorInitializationException
     */
    public static function __constructStatic(RequestInterface $request)
    {

        self::checkSingleConstructorInitialization();

        self::$constructorInitialization = true;

        self::$request = $request;
        self::$response = new Response(self::$request->header);

    }

    /**
     * @throws ConstructorNotInitializedException
     */
    private static function checkConstructorInitialization(): void
    {

        if (false === self::$constructorInitialization) {
            throw new ConstructorNotInitializedException('__constructStatic');
        }

    }

    /**
     * @throws SingleConstructorInitializationException
     */
    private static function checkSingleConstructorInitialization(): void
    {

        if (self::$constructorInitialization) {
            throw new SingleConstructorInitializationException('__constructStatic');
        }

    }

}