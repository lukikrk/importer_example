<?php

declare(strict_types=1);

namespace App\Core\Application\CQRS;

interface EventBus
{
    /** @psalm-suppress PossiblyUnusedMethod */
    public function dispatch(Event $event): void;
}
