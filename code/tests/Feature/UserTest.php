<?php

namespace TaskTrek\Tests\Feature;

use TaskTrek\Core\Application\DTOs\CreateUserDTO;
use TaskTrek\Core\Application\DTOs\UserDTO;
use TaskTrek\Core\Application\Exceptions\ResourceNotFountException;
use TaskTrek\Core\Application\UseCases\User\CreateUserUseCase;
use TaskTrek\Core\Application\UseCases\User\DeleteUserUseCase;
use TaskTrek\Core\Application\UseCases\User\UpdateUserUseCase;
use TaskTrek\Core\Domain\User\UserEntity;
use TaskTrek\Core\Domain\ValueObjects\UUIDv4;
use TaskTrek\Tests\TestRepositories\UserTestRepository;

it('should create a new user', function () {
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
    expect($userEntity->getUserId())->toBeInt();
    $user = $userRepository->findById($userEntity->getUserId());
    expect($user)->toBeInstanceOf(UserEntity::class);
    expect($user->getUuid()->getValue())->toEqual($uuid);
});

it('should update an user', function () {
    $userRepository = new UserTestRepository();
    $createUserUseCase = new CreateUserUseCase($userRepository);
    $uuid = UUIDv4::generate();
    expect($uuid)->toBeUuid();
    $userDTO = new CreateUserDTO(
        uuid: $uuid,
        email: 'YnQp3@example.com',
        name: 'John Doe'
    );
    $userEntity = $createUserUseCase->execute($userDTO);
    $user = $userRepository->findById($userEntity->getUserId());
    expect($user)->toBeInstanceOf(UserEntity::class);
    expect($user->getUuid()->getValue())->toEqual($uuid);
    expect($user->getName())->toEqual('John Doe');

    $userUseCase = new UpdateUserUseCase($userRepository);
    $updateUserDTO = (new UserDTO(uuid: $user->getUuid()->getValue()))
        ->setUserId($userEntity->getUserId())
        ->setName('Foo Bar')
        ->setEmail('abcd@example.com');
    $userUseCase->execute($updateUserDTO);
    $user = $userRepository->findById($user->getUserId());
    expect($user)->toBeInstanceOf(UserEntity::class);
    expect($user->getUuid()->getValue())->toEqual($uuid);
    expect($user->getName())->toEqual('Foo Bar');
    expect($user->getEmail()->getValue())->toEqual('abcd@example.com');
});

it('should delete an user', function () {
    $userRepository = new UserTestRepository();
    $createUserUseCase = new CreateUserUseCase($userRepository);
    $uuid = UUIDv4::generate();
    expect($uuid)->toBeUuid();
    $userDTO = new CreateUserDTO(
        uuid: $uuid,
        email: 'YnQp3@example.com',
        name: 'John Doe'
    );
    $userEntity = $createUserUseCase->execute($userDTO);
    $userDTO->setUserId($userEntity->getUserId());
    $user = $userRepository->findById($userEntity->getUserId());
    expect($user)->toBeInstanceOf(UserEntity::class);

    $deleteUserUseCase = new DeleteUserUseCase($userRepository);
    $deleteUserUseCase->execute($userEntity->getUserId());
    $findFunction = fn () => ($userRepository->findById($userEntity->getUserId()));
    expect($findFunction)->toThrow(ResourceNotFountException::class, "User not found [{$userEntity->getUserId()}]");
});
