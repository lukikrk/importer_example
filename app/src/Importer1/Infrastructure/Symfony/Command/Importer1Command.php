<?php

declare(strict_types=1);

namespace App\Importer1\Infrastructure\Symfony\Command;

use App\Importer1\Domain\Importer1;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:importer1:import', description: 'Import data from importer 1')]
final class Importer1Command extends Command
{
    public function __construct(
        private readonly Importer1 $importer,
        ?string $name = null,
    ) {
        parent::__construct($name);
    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->importer->requestImport();

        return Command::SUCCESS;
    }
}
