<?php

declare(strict_types=1);

namespace App\Core\Application\CQRS\Command;

use App\Core\Application\CQRS\Command;

final readonly class Import implements Command
{
    public function __construct(
        public string $id,
        /** @var class-string */
        public string $importer,
    ) {
    }
}
