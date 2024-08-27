<?php

declare(strict_types=1);

namespace App\Core\Domain\Importer;

enum Status: string
{
    case ok = 'OK';

    case failed = 'FAILED';
}
