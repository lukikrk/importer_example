<?php

declare(strict_types=1);

namespace App\Importer1\Domain\Importer;

use App\Core\Application\CQRS\CommandBus;
use App\Core\Application\Importer\CQRSImporter;
use App\Core\Domain\Importer\Importer;
use App\Core\Domain\Importer\Result;
use App\Core\Domain\Manager\FileManager;
use App\Core\Domain\Mapper\DataMapper;
use App\Core\Domain\Provider\DataProvider;
use App\Core\Domain\Provider\Input\APIInput;
use App\Importer1\Domain\Importer1;

final readonly class APIImporter1 extends CQRSImporter implements Importer, Importer1
{
    public function __construct(
        CommandBus $commandBus,
        private DataProvider $dataProvider,
        private DataMapper $dataMapper,
        private FileManager $fileManager,
        private string $importer1Url,
        private string $projectDir,
    ) {
        parent::__construct($commandBus);
    }

    public function import(): Result
    {
        try {
            //@todo consider introducing pagination mechanism...
            $data = $this->dataProvider->provide(new APIInput($this->importer1Url));

            $data = $this->dataMapper->map($data);

            //@todo ...append mode for writing into file
            $this->fileManager->write(
                sprintf('%s/public/import/api1-%s.json', $this->projectDir, date('YmdHis')),
                $data,
            );

            return Result::ok();
        } catch (\Exception $exception) {
            return Result::failed($exception->getMessage());
        }
    }

    public function supports(string $class): bool
    {
        return self::class === $class;
    }
}
