<?php

use TaskTrek\Infra\Services\DotNotationExtractor;

test('extracts value from array by string', function () {
    $array = ['country' => ['name' => 'Canada', 'Capital' => 'Ottawa']];
    $string = 'country.name';

    $extractor = new DotNotationExtractor();
    expect($extractor->extract($array, $string))->toBe('Canada');
});

test('returns default value if string does not match', function () {
    $array = ['country' => ['name' => 'Canada', 'Capital' => 'Ottawa']];
    $string = 'country.population';
    $default = 'Unknown';

    $extractor = new DotNotationExtractor();
    expect($extractor->extract($array, $string, $default))->toBe('Unknown');
});

test('returns default value if array is empty', function () {
    $array = [];
    $string = 'country.name';
    $default = 'Unknown';

    $extractor = new DotNotationExtractor();
    expect($extractor->extract($array, $string, $default))->toBe('Unknown');
});

test('returns null if no default value is provided and string does not match', function () {
    $array = ['country' => ['name' => 'Canada', 'Capital' => 'Ottawa']];
    $string = 'country.population';

    $extractor = new DotNotationExtractor();
    expect($extractor->extract($array, $string))->toBeNull();
});
