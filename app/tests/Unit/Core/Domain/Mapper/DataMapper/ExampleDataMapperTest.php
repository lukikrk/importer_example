<?php

declare(strict_types=1);

namespace App\Tests\Unit\Core\Domain\Mapper\DataMapper;

use App\Core\Domain\Mapper\DataMapper\ExampleDataMapper;
use App\Tests\Configuration\Core\Domain\Mapper\DataMapper\ExampleDataMapperConfiguration;
use App\Tests\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

final class ExampleDataMapperTest extends UnitTestCase
{
    private ExampleDataMapper $mapper;

    public function setUp(): void
    {
        $this->mapper = ExampleDataMapperConfiguration::exampleDataMapper();

        parent::setUp();
    }

    public function tearDown(): void
    {
        unset($this->mapper);

        parent::tearDown();
    }

    #[Test]
    public function itShouldMapData(): void
    {
        $data = json_encode(['example' => 'data']);

        $data = $this->mapper->map($data);

        $this->assertSame('{"example":"DATA"}', $data);
    }
}
