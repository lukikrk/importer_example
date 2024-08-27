<?php

declare(strict_types=1);

namespace App\Core\Application\Importer;

use App\Core\Application\CQRS\Command\Import;
use App\Core\Application\CQRS\CommandBus;
use Ramsey\Uuid\Uuid;

abstract readonly class CQRSImporter
{
    public function __construct(
        protected CommandBus $commandBus,
    ) {
    }

    public function requestImport(): void
    {
        $this->commandBus->dispatch(new Import(
            Uuid::uuid4()->toString(),
            static::class
        ));
    }
}
