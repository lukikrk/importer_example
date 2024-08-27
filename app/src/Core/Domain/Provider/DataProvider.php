<?php

declare(strict_types=1);

namespace App\Core\Domain\Provider;

interface DataProvider
{
    public function provide(Input $input): string;
}
