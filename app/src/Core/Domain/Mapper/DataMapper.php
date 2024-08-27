<?php

declare(strict_types=1);

namespace App\Core\Domain\Mapper;

interface DataMapper
{
    public function map(string $data): string;
}
