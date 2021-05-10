<?php

declare(strict_types=1);

namespace Leverage\CommandRunner\Command;

class HelloCommand
{
    private const SUCCESS = 0;

    public function __invoke(): int
    {
        echo "Hello World\n";
        return self::SUCCESS;
    }
}
