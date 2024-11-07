<?php

namespace TaskTrek\Domain\Helpers;

interface UuidInterface
{
    public function __construct(string $uuid);
    public static function generate(): string;
    public function isValid(): bool;
}