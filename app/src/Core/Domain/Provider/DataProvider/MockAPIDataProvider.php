<?php

declare(strict_types=1);

namespace App\Core\Domain\Provider\DataProvider;

use App\Core\Domain\Provider\DataProvider;
use App\Core\Domain\Provider\Input;
use App\Core\Domain\Provider\Input\APIInput;
use Exception;

final class MockAPIDataProvider implements DataProvider
{
    /** @param array<Input> $apiCalls */
    public function __construct(
        private array $apiCalls = [],
        private bool $exceptionMode = false,
    ) {
    }

    /** @param Input&APIInput $input */
    public function provide(Input $input): string
    {
        if (true === $this->exceptionMode) {
            throw new Exception('API unavailable.');
        }

        $this->apiCalls[] = $input;

        return json_encode(['property1' => 'example', 'property2' => 'example2']);
    }

    /** @return array<Input> */
    public function getApiCalls(): array
    {
        return $this->apiCalls;
    }

    public function setExceptionMode(bool $exceptionMode): void
    {
        $this->exceptionMode = $exceptionMode;
    }
}
