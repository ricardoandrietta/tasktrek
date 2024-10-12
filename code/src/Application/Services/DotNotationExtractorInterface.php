<?php

namespace TaskTrek\Application\Services;

interface DotNotationExtractorInterface
{
    public function extract(array $data, string $path, mixed $default = null): mixed;
}
