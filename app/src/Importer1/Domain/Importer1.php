<?php

declare(strict_types=1);

namespace App\Importer1\Domain;

interface Importer1
{
    public function requestImport(): void;
}
