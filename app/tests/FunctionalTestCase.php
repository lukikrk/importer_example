<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class FunctionalTestCase extends KernelTestCase
{
    protected function setUp(): void
    {
        array_map('unlink', array_filter(
            (array) glob(sprintf('%s/../public/import/*.json', __DIR__)),
        ));

        parent::setUp();
    }

    protected function assertImportSuccessful(): void
    {
        $files = (array) glob(sprintf('%s/../public/import/*.json', __DIR__));

        $this->assertCount(1, $files);
    }
}
