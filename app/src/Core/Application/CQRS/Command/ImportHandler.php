<?php

declare(strict_types=1);

namespace App\Core\Application\CQRS\Command;

use App\Core\Application\CQRS\CommandHandler;
use App\Core\Domain\Importer\ImporterAggregator;
use Psr\Log\LoggerInterface;

final readonly class ImportHandler implements CommandHandler
{
    public function __construct(
        private ImporterAggregator $aggregator,
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(Import $command): void
    {
        $result = $this->aggregator->import($command->importer);

        $this->logger->log($result->logLevel(), $result->message);
    }
}
