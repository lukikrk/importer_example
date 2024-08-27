<?php

declare(strict_types=1);

namespace App\Tests\Unit\Importer\Domain\Importer;

use App\Core\Application\CQRS\Command\Import;
use App\Core\Domain\Importer\Result;
use App\Core\Domain\Importer\Status;
use App\Core\Domain\Provider\DataProvider\MockAPIDataProvider;
use App\Core\Infrastructure\InMemory\CQRS\CommandBus;
use App\Importer1\Domain\Importer\APIImporter1;
use App\Tests\Configuration\Importer1\Domain\Importer\ApiImporter1Configuration;
use App\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

final class APIImporter1Test extends UnitTestCase
{
    private CommandBus $commandBus;

    private MockAPIDataProvider $dataProvider;

    private APIImporter1 $importer;

    protected function setUp(): void
    {
        $this->commandBus = new CommandBus();
        $this->dataProvider = new MockAPIDataProvider();
        $this->importer = ApiImporter1Configuration::apiImporter1(
            $this->commandBus,
            $this->dataProvider,
        );

        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->commandBus);
        unset($this->dataProvider);
        unset($this->importer);

        parent::tearDown();
    }

    #[Test]
    public function itShouldRequestForImport(): void
    {
        $this->importer->requestImport();

        $commands = $this->commandBus->getCommands();

        $this->assertCount(1, $commands);

        $command = $commands[0];

        $this->assertInstanceOf(Import::class, $command);
        $this->assertSame(APIImporter1::class, $command->importer);


    }

    #[Test]
    public function itShouldImport(): void
    {
        $result = $this->importer->import();

        $this->assertInstanceOf(Result::class, $result);
        $this->assertSame(Status::ok, $result->status);
        $this->assertSame('Imported successfully.', $result->message);
    }

    #[Test]
    public function itShouldReturnFailedResultWhenAPIUnavailable(): void
    {
        $this->dataProvider->setExceptionMode(true);

        $result = $this->importer->import();

        $this->assertInstanceOf(Result::class, $result);
        $this->assertSame(Status::failed, $result->status);
        $this->assertSame('API unavailable.', $result->message);
    }
}
