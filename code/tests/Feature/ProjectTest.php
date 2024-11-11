<?php

use TaskTrek\Core\Application\DTOs\CreateUserDTO;
use TaskTrek\Core\Application\UseCases\User\CreateUserUseCase;
use TaskTrek\Core\Domain\ValueObjects\UUIDv4;
use TaskTrek\Tests\TestRepositories\UserTestRepository;

it('should create a project', function () {
    $userRepository = new UserTestRepository();
    $userUseCase = new CreateUserUseCase($userRepository);
    $uuid = UUIDv4::generate();
    expect($uuid)->toBeUuid();
    $userDTO = new CreateUserDTO(
        uuid: $uuid,
        email: 'YnQp3@example.com',
        name: 'John Doe'
    );
    $userEntity = $userUseCase->execute($userDTO);
});
