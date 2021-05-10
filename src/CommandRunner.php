<?php

declare(strict_types=1);

namespace Leverage\CommandRunner;

use Exception;
use Leverage\CommandRunner\Exception\UsageException;

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

        $name = $args[1];

        if (!array_key_exists($name, $this->commands)) {
            throw new Exception("Unknown command {$name}");
        }

        $class = $this->commands[$name];
        $command = new $class;

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
}
