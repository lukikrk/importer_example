<?php

declare(strict_types=1);

namespace App\Core\Application\CQRS;

interface QueryBus
{
    /** @psalm-suppress PossiblyUnusedMethod */
    public function query(Query $query): mixed;
}
