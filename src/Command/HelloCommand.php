<?php

declare(strict_types=1);

namespace Leverage\CommandRunner\Command;

use Leverage\CommandRunner\Interfaces\CommandInterface;

class HelloCommand implements CommandInterface
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
