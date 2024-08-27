<?php

declare(strict_types=1);

namespace App\Core\Application\CQRS;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
