<?php

namespace TaskTrek\Domain\Helpers;

interface UuidGeneratorInterface
{
    public static function generate(): string;
}
