<?php

declare(strict_types=1);

namespace App\Core\Domain\Importer;

use RuntimeException;

final readonly class ImporterAggregator
{
    /** @param iterable<Importer> $importers */
    public function __construct(
        private iterable $importers,
    ) {
    }

    public function requestImport(): void
    {
        foreach ($this->importers as $importer) {
            $importer->requestImport();
        }
    }

    /** @param class-string $class */
    public function import(string $class): Result
    {
        foreach ($this->importers as $importer) {
            if (true === $importer->supports($class)) {
                return $importer->import();
            }
        }

        throw new RuntimeException(sprintf('Importer not supported: %s', $class));
    }
}
