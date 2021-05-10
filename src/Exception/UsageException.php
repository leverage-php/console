<?php

declare(strict_types=1);

namespace Leverage\CommandRunner\Exception;

use Exception;

class UsageException extends Exception
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
