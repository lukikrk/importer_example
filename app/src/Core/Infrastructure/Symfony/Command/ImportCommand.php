<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Symfony\Command;

use App\Core\Domain\Importer\ImporterAggregator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:import', description: 'Import data from all importers')]
class ImportCommand extends Command
{
    public function __construct(
        private readonly ImporterAggregator $importer,
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
