<?php

declare(strict_types=1);

namespace Leverage\CommandRunner\Command;

use Leverage\CommandRunner\Interfaces\CommandInterface;

class FooBarCommand implements CommandInterface
{
    private const SUCCESS = 0;

    public function configure(): array
    {
        return [];
    }

    public function __invoke(
        array $args
    ): int {
        echo "Hello nesting!\n";
        return self::SUCCESS;
    }
}
