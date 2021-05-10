<?php

declare(strict_types=1);

namespace Test\Exception;

use Leverage\CommandRunner\Exception\UsageException;
use PHPUnit\Framework\TestCase;

class UsageExceptionTest extends TestCase
{
    public function test(): void
    {
        $ex = new UsageException('command', [
            'arg1',
            'arg2',
        ]);
        $message = $ex->getMessage();
        $this->assertSame('command <arg1> <arg2>', $message);
    }
}
