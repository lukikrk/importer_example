<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Symfony\CQRS;

use App\Core\Application\CQRS\Event;
use App\Core\Application\CQRS\EventBus as EventBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final readonly class EventBus implements EventBusInterface
{
    public function __construct(
        private MessageBusInterface $eventBus,
    ) {
    }

    public function dispatch(Event $event): void
    {
        $this->eventBus->dispatch($event, [new DispatchAfterCurrentBusStamp()]);
    }
}
