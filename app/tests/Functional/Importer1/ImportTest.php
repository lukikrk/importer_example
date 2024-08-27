<?php

declare(strict_types=1);

namespace App\Tests\Functional\Importer1;

use App\Tests\FunctionalTestCase;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

final class ImportTest extends FunctionalTestCase
{
    #[Test]
    public function itShouldMakeImport(): void
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('app:importer1:import');

        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $commandTester->assertCommandIsSuccessful();
        $this->assertImportSuccessful();
    }
}
