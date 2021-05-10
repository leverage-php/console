<?php

declare(strict_types=1);

namespace Leverage\CommandRunner\Interfaces;

interface CommandInterface
{
    public function run(): int;
}
