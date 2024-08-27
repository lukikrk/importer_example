<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\InMemory\CQRS;

use App\Core\Application\CQRS\Command;
use App\Core\Application\CQRS\CommandBus as CommandBusInterface;

final class CommandBus implements CommandBusInterface
{
    /** @var array<Command> */
    private array $commands = [];

    public function dispatch(Command $command): void
    {
        $this->commands[] = $command;
    }

    /** @return array<Command> */
    public function getCommands(): array
    {
        return $this->commands;
    }
}
