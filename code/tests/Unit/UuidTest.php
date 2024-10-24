<?php

it('generates a valid UUIDv4', function () {
    $uuid = \TaskTrek\Domain\ValueObjects\UUIDv4::generate();

    // Regular expression to match the UUIDv4 format
    $uuidRegex = '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

    $this->assertMatchesRegularExpression($uuidRegex, $uuid);
});

test('isValid should return false for an invalid UUID', function () {
    $uuid = '8a8a8a8a-8a8a-8a8a-8a8a-8a8a8a8a8a8a';
    $uuidObject = new \TaskTrek\Domain\ValueObjects\UUIDv4($uuid);
    $this->assertFalse($uuidObject->isValid());
});

test('isValid should return true for a valid UUID', function () {
    $uuid = \TaskTrek\Domain\ValueObjects\UUIDv4::generate();
    $uuidObject = new \TaskTrek\Domain\ValueObjects\UUIDv4($uuid);
    $this->assertTrue($uuidObject->isValid());
});

it('generates unique UUIDs', function () {
    $uuid1 = \TaskTrek\Domain\ValueObjects\UUIDv4::generate();
    $uuid2 = \TaskTrek\Domain\ValueObjects\UUIDv4::generate();

    // Assert that two generated UUIDs are not the same
    $this->assertNotSame($uuid1, $uuid2);
});
