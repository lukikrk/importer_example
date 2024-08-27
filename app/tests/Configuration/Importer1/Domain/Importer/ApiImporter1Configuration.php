<?php

declare(strict_types=1);

namespace App\Tests\Configuration\Importer1\Domain\Importer;

use App\Core\Application\CQRS\CommandBus as CommandBusInterface;
use App\Core\Domain\Provider\DataProvider;
use App\Core\Domain\Provider\DataProvider\MockAPIDataProvider;
use App\Core\Infrastructure\InMemory\CQRS\CommandBus;
use App\Importer1\Domain\Importer\APIImporter1;
use App\Tests\Configuration\Core\Domain\Mapper\DataMapper\ExampleDataMapperConfiguration;
use App\Tests\Configuration\Core\Infrastructure\Local\Manager\FileManagerConfiguration;

final readonly class ApiImporter1Configuration
{
    public static function apiImporter1(
        ?CommandBusInterface $commandBus = null,
        ?DataProvider $dataProvider = null,
    ): APIImporter1 {
        return new APIImporter1(
            $commandBus ?? new CommandBus(),
            $dataProvider ?? new MockAPIDataProvider(),
            ExampleDataMapperConfiguration::exampleDataMapper(),
            FileManagerConfiguration::fileManager(),
            'http://testapi.com',
            sprintf('%s/../../../../../', __DIR__)
        );
    }
}
