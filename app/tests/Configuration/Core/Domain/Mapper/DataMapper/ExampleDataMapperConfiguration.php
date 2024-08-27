<?php

declare(strict_types=1);

namespace App\Tests\Configuration\Core\Domain\Mapper\DataMapper;

use App\Core\Domain\Mapper\DataMapper\ExampleDataMapper;

final readonly class ExampleDataMapperConfiguration
{
    public static function exampleDataMapper(): ExampleDataMapper
    {
        return new ExampleDataMapper();
    }
}
