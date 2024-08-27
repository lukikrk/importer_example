<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

abstract class UnitTestCase extends TestCase
{
    protected function setUp(): void
    {
        array_map('unlink', array_filter(
            (array) glob(sprintf('%s/../public/import/*.json', __DIR__)),
        ));

        parent::setUp();
    }
}
