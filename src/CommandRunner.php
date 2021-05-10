<?php

declare(strict_types=1);

namespace Leverage\CommandRunner;

use Exception;

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
        return $command();
    }
}
