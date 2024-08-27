<?php

declare(strict_types=1);

namespace App\Tests\Configuration\Core\Infrastructure\Local\Manager;

use App\Core\Infrastructure\Local\Manger\FileManager;

final readonly class FileManagerConfiguration
{
    public static function fileManager(): FileManager
    {
        return new FileManager();
    }
}
