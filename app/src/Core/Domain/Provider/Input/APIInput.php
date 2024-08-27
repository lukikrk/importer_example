<?php

declare(strict_types=1);

namespace App\Core\Domain\Provider\Input;

use App\Core\Domain\Provider\Input;

final readonly class APIInput implements Input
{
    /** @param array<string, mixed> $body */
    public function __construct(
        public string $url,
        public string $method = 'GET',
        public array $body = [],
    ) {
    }
}
