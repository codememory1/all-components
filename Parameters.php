<?php

namespace Codememory\Routing;

use Codememory\Routing\Interfaces\ParametersInterface;

/**
 * Class Parameters
 * @package Codememory\Routing
 *
 * @author  Codememory
 */
class Parameters implements ParametersInterface
{

    public const DEFAULT_PARAMETER_REGEX = '.*';
    public const PARAMETER_START_CHARACTER = ':';
    private const PARAMETER_NAME_REGEX = '[a-zA-Z\_\-\.]{2,}';

    /**
     * @var string
     */
    private string $routePath;

    /**
     * Parameters constructor.
     *
     * @param string $routePath
     */
    public function __construct(string $routePath)
    {

        $this->routePath = $routePath;

    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {

        $regex = sprintf('/\%s(?<parameters>%s)/', self::PARAMETER_START_CHARACTER, self::PARAMETER_NAME_REGEX);

        preg_match_all($regex, $this->routePath, $match);

        return $match['parameters'];

    }

    /**
     * @inheritDoc
     */
    public function getFirstParameter(): ?string
    {

        if ([] !== $this->all()) {
            $firstKey = array_key_first($this->all());

            return $this->all()[$firstKey];
        }

        return null;

    }

    /**
     * @inheritDoc
     */
    public function getLastParameter(): ?string
    {

        if ([] !== $this->all()) {
            $lastKey = array_key_last($this->all());

            return $this->all()[$lastKey];
        }

        return null;

    }

}