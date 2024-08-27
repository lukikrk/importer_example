<?php

declare(strict_types=1);

namespace App\Core\Domain\Mapper\DataMapper;

use App\Core\Domain\Mapper\DataMapper;

final readonly class ExampleDataMapper implements DataMapper
{
    public function map(string $data): string
    {
        $data = json_decode($data, true, JSON_THROW_ON_ERROR);

        $data = array_map(static fn (string $string): string => strtoupper($string), $data);

        return json_encode($data, JSON_THROW_ON_ERROR);
    }
}
