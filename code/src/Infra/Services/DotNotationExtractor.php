<?php

declare(strict_types=1);

namespace TaskTrek\Infra\Services;

use TaskTrek\Application\Services\DotNotationExtractorInterface;

class DotNotationExtractor implements DotNotationExtractorInterface
{
    public function extract(array $data, string $path, mixed $default = null): mixed
    {
        $keys = explode('.', $path);
        $value = $data;

        foreach ($keys as $key) {
            if (is_array($value) && array_key_exists($key, $value)) {
                $value = $value[$key];
            } else {
                return $default;
            }
        }

        return $value;
    }
}
