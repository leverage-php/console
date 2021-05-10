<?php

declare(strict_types=1);

namespace Leverage\CommandRunner;

use Exception;
use Leverage\CommandRunner\Exception\UsageException;
use Leverage\CommandRunner\Interfaces\CommandInterface;

class CommandRunner
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
            throw new Exception('No command specified');
        }

        $command = $this->getCommand($args[1]);

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
                throw new Exception("Unknown command {$name}");
            }

            $lookup = $lookup[$part];
        }

        return new $lookup;
    }
}
