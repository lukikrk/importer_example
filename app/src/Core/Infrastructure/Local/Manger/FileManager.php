<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Local\Manger;

use App\Core\Domain\Manager\FileManager as FileManagerInterface;

final readonly class FileManager implements FileManagerInterface
{
    public function write(string $path, mixed $data): void
    {
        file_put_contents($path, $data);
    }
}
