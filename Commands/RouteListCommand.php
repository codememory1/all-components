<?php

namespace Codememory\Routing\Commands;

use Codememory\Components\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class RouteListCommand
 * @package Codememory\Routing\Commands
 *
 * @author  Codemmeory
 */
class RouteListCommand extends Command
{

    /**
     * @var string|null
     */
    protected ?string $command = 'route:list';

    /**
     * @inheritDoc
     */
    protected function handler(InputInterface $input, OutputInterface $output): int
    {
        // TODO: Implement handler() method.
    }
}