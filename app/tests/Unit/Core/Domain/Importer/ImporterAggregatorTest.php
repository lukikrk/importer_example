<?php

declare(strict_types=1);

namespace App\Tests\Unit\Core\Domain\Importer;

use App\Core\Application\CQRS\Command\Import;
use App\Core\Domain\Importer\ImporterAggregator;
use App\Core\Domain\Importer\Result;
use App\Core\Domain\Importer\Status;
use App\Core\Infrastructure\InMemory\CQRS\CommandBus;
use App\Importer1\Domain\Importer\APIImporter1;
use App\Tests\Configuration\Core\Domain\Importer\ImporterAggregatorConfiguration;
use App\Tests\Configuration\Importer1\Domain\Importer\ApiImporter1Configuration;
use App\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

final class ImporterAggregatorTest extends UnitTestCase
{
    private CommandBus $commandBus;

    private ImporterAggregator $aggregator;

    protected function setUp(): void
    {
        $this->commandBus = new CommandBus();
        $this->aggregator = ImporterAggregatorConfiguration::importerAggregator([
            ApiImporter1Configuration::apiImporter1($this->commandBus),
        ]);

        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->commandBus);
        unset($this->aggregator);

        parent::tearDown();
    }

    #[Test]
    public function itShouldRequestForImport(): void
    {
        $this->aggregator->requestImport();

        $commands = $this->commandBus->getCommands();

        $this->assertCount(1, $commands);

        $command = $commands[0];

        $this->assertInstanceOf(Import::class, $command);
        $this->assertSame(APIImporter1::class, $command->importer);
    }

    #[Test]
    public function itShouldImport(): void
    {
        $result = $this->aggregator->import(APIImporter1::class);

        $this->assertInstanceOf(Result::class, $result);
        $this->assertSame(Status::ok, $result->status);
        $this->assertSame('Imported successfully.', $result->message);
    }

    #[Test]
    public function testShouldThrowExceptionWhenInvalidImporterGiven(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Importer not supported: stdClass');

        $this->aggregator->import(\stdClass::class);
    }
}
