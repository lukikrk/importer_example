<?php

declare(strict_types=1);

namespace App\Core\Domain\Importer;

use Psr\Log\LogLevel;

final readonly class Result
{
    public function __construct(
        public Status $status,
        public string $message,
    ) {
    }

    /** @SuppressWarnings(PHPMD.ShortMethodName) */
    public static function ok(): Result
    {
        return new self(Status::ok, 'Imported successfully.');
    }

    public static function failed(string $message): Result
    {
        return new self(Status::failed, $message);
    }

    public function logLevel(): string
    {
        return match ($this->status) {
            Status::ok => LogLevel::INFO,
            Status::failed => LogLevel::ERROR,
        };
    }
}
