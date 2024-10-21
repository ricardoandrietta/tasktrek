<?php

it('generates a valid UUIDv4', function () {
    $uuid = \TaskTrek\Infra\Helpers\UUID::generate();

    // Regular expression to match the UUIDv4 format
    $uuidRegex = '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

    $this->assertMatchesRegularExpression($uuidRegex, $uuid);
});

it('generates unique UUIDs', function () {
    $uuid1 = \TaskTrek\Infra\Helpers\UUID::generate();
    $uuid2 = \TaskTrek\Infra\Helpers\UUID::generate();

    // Assert that two generated UUIDs are not the same
    $this->assertNotSame($uuid1, $uuid2);
});
