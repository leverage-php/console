<?php

declare(strict_types=1);

namespace Leverage\Console;

use Exception;
use Leverage\Console\Exception\ConsoleException;
use Leverage\Console\Exception\UsageException;
use Leverage\Console\Interfaces\CommandInterface;

class Console
{
    /** @var array<CommandInterface> */
    private $commands;

    public function registerCommands(
        array $commands
    ): self {
        $this->commands = $commands;
        return $this;
    }

    public function run(
        array $args
    ): int {
        if (count($args) < 2) {
            throw new ConsoleException('No command specified');
        }

        $name = $args[1];
        $command = $this->getCommand($name);

        $args = array_slice($args, 2);
        $argNames = $command->configure();

        if (count($args) != count($argNames)) {
            throw new UsageException($name, $argNames);
        }

        $argMap = [];
        for ($i = 0; $i < count($args); ++$i) {
            $argMap[$argNames[$i]] = $args[$i];
        }

        return $command($argMap);
    }

    private function getCommand(
        string $name
    ): CommandInterface {
        $parts = explode(':', $name);

        $lookup = $this->commands;
        while ($parts) {
            $part = array_shift($parts);

            if (!array_key_exists($part, $lookup)) {
                throw new ConsoleException("Unknown command {$name}");
            }

            $lookup = $lookup[$part];
        }

        return new $lookup;
    }
}
