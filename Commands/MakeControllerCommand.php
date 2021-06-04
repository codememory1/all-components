<?php

namespace Codememory\Routing\Commands;

use Codememory\Components\Console\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MakeControllerCommand
 * @package Codememory\Routing\Commands
 *
 * @author  Codememory
 */
class MakeControllerCommand extends Command
{

    /**
     * @var string|null
     */
    protected ?string $command = 'make:controller';

    /**
     * @var string|null
     */
    protected ?string $description = 'Create controller';

    /**
     * @inheritDoc
     */
    protected function handler(InputInterface $input, OutputInterface $output): int
    {
        // TODO: Implement handler() method.
    }

}