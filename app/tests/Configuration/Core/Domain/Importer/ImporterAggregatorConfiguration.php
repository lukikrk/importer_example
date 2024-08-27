<?php

declare(strict_types=1);

namespace App\Tests\Configuration\Core\Domain\Importer;

use App\Core\Domain\Importer\Importer;
use App\Core\Domain\Importer\ImporterAggregator;
use App\Tests\Configuration\Importer1\Domain\Importer\ApiImporter1Configuration;

final readonly class ImporterAggregatorConfiguration
{
    /** @param array<Importer> $importers */
    public static function importerAggregator(?array $importers = null): ImporterAggregator
    {
        return new ImporterAggregator(
            $importers ?? [ApiImporter1Configuration::apiImporter1()]
        );
    }
}
