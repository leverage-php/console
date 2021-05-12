<?php

declare(strict_types=1);

namespace Leverage\Console\Interfaces;

interface CommandInterface
{
    public function configure(): array;
    public function __invoke(
        array $args
    ): int;
}
