<?php

declare(strict_types=1);

namespace App\Core\Domain\Manager;

interface FileManager
{
    public function write(string $path, mixed $data): void;
}
