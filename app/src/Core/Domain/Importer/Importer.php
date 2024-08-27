<?php

declare(strict_types=1);

namespace App\Core\Domain\Importer;

interface Importer
{
    public function requestImport(): void;

    public function import(): Result;

    /** @param class-string $class */
    public function supports(string $class): bool;
}
