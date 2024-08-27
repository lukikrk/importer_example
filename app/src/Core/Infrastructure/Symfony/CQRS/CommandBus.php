<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Symfony\CQRS;

use App\Core\Application\CQRS\Command;
use App\Core\Application\CQRS\CommandBus as CommandBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class CommandBus implements CommandBusInterface
{
    public function __construct(
        private MessageBusInterface $bus,
    ) {
    }

    public function dispatch(Command $command): void
    {
        $this->bus->dispatch($command);
    }
}
