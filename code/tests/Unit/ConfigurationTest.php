<?php

use TaskTrek\Core\Infra\Services\ConfigurationService;

test('get data from section should return array', function () {
    $configMock = Mockery::mock(ConfigurationService::class);
    $configMock->makePartial();
    $configMock->shouldAllowMockingProtectedMethods();
    $configMock
        ->shouldReceive('dbSearch')
        ->andReturn(['country' => ['name' => 'canada', 'capital' => 'ottawa', 'population' => 40000]]);
    $data = $configMock->get('data', 'country');
    expect($data)->toBeArray();
});

test('get data from section should return int', function () {
    $configMock = Mockery::mock(ConfigurationService::class);
    $configMock->makePartial();
    $configMock->shouldAllowMockingProtectedMethods();
    $configMock
        ->shouldReceive('dbSearch')
        ->andReturn(['year' => '1981', 'population' => 40000, 'age' => null, 'is_cool' => true]);

    $data = $configMock->get('data', 'population');
    expect($data)
        ->toBeInt()
        ->and($data)->toBe(40000);

    $data = $configMock->getAsInt('data', 'year');
    expect($data)
        ->toBeInt()
        ->and($data)->toBe(1981);

    $data = $configMock->getAsInt('data', 'age');
    expect($data)
        ->toBeInt()
        ->and($data)->toBe(0);

    $data = $configMock->getAsInt('data', 'is_cool');
    expect($data)
        ->toBeInt()
        ->and($data)->toBe(1);
});

test('get data from section should return boolean', function () {
    $configMock = Mockery::mock(ConfigurationService::class);
    $configMock->makePartial();
    $configMock->shouldAllowMockingProtectedMethods();
    $configMock
        ->shouldReceive('dbSearch')
        ->andReturn([
                        'bool_true' => true,
                        'bool_false' => false,
                        'string_true' => 'true',
                        'string_false' => 'false',
                        'int_true' => 1,
                        'int_false' => 0
                    ]);
    $data = $configMock->getAsBoolean('data', 'bool_true');
    expect($data)
        ->toBeBool()
        ->and($data)->toBeTrue();

    $data = $configMock->getAsBoolean('data', 'bool_false');
    expect($data)
        ->toBeBool()
        ->and($data)->toBeFalse();

    $data = $configMock->getAsBoolean('data', 'string_true');
    expect($data)
        ->toBeBool()
        ->and($data)->toBeTrue();

    $data = $configMock->getAsBoolean('data', 'string_false');
    expect($data)
        ->toBeBool()
        ->and($data)->toBeFalse();

    $data = $configMock->getAsBoolean('data', 'int_true');
    expect($data)
        ->toBeBool()
        ->and($data)->toBeTrue();

    $data = $configMock->getAsBoolean('data', 'int_false');
    expect($data)
        ->toBeBool()
        ->and($data)->toBeFalse();
});
