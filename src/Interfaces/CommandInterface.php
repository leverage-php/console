<?php

declare(strict_types=1);

namespace Leverage\CommandRunner\Interfaces;

interface CommandInterface
{
    public function configure(): array;
    public function run(): int;
}
