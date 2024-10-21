<?php

declare(strict_types=1);

namespace TaskTrek\Infra\Helpers;

use TaskTrek\Domain\Helpers\UuidGeneratorInterface;

class UUID implements UuidGeneratorInterface
{
    public static function generate(): string
    {
        // Generate 16 random bytes
        $data = random_bytes(16);

        // Set the version to 4 (0100 in binary)
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);

        // Set the variant to 2 (10 in binary)
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Return the UUID as a formatted string
        return sprintf(
            '%s-%s-%s-%s-%s',
            bin2hex(substr($data, 0, 4)),   // First 4 bytes
            bin2hex(substr($data, 4, 2)),   // Next 2 bytes
            bin2hex(substr($data, 6, 2)),   // Next 2 bytes (with version 4)
            bin2hex(substr($data, 8, 2)),   // Next 2 bytes (with variant)
            bin2hex(substr($data, 10, 6))   // Last 6 bytes
        );
    }
}
