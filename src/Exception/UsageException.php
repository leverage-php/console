<?php

declare(strict_types=1);

namespace Leverage\Console\Exception;

class UsageException extends ConsoleException
{
    public function __construct(
        string $command,
        array $args
    ) {
        $message = "Usage: $command";

        if ($args) {
            $message .= ' <' . implode('> <', $args) . '>';
        }

        parent::__construct($message);
    }
}
