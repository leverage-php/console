<?php

declare(strict_types=1);

namespace Leverage\CommandRunner\Command;

class HelloCommand
{
    private const NAME = 'name';

    private const SUCCESS = 0;

    public function configure(): array
    {
        return [
            self::NAME,
        ];
    }

    public function __invoke(
        array $args
    ): int {
        echo "Hello {$args[self::NAME]}\n";
        return self::SUCCESS;
    }
}
