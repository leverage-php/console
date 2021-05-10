<?php

use Leverage\CommandRunner\Command;

return [
    'foo' => [
        'bar' => Command\FooBarCommand::class,
    ],
    'hello' => Command\HelloCommand::class,
];
