<?php

use TaskTrek\Application\DTOs\CreateUserDTO;
use TaskTrek\Application\DTOs\UserDTO;
use TaskTrek\Application\Exceptions\ResourceNotFountException;
use TaskTrek\Application\UseCases\User\CreateUserUseCase;
use TaskTrek\Application\UseCases\User\DeleteUserUseCase;
use TaskTrek\Application\UseCases\User\UpdateUserUseCase;
use TaskTrek\Domain\User\UserEntity;
use TaskTrek\Domain\ValueObjects\UUIDv4;
use Tests\TestRepositories\UserTestRepository;

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
    expect($userEntity->getId())->toBeInt();
    $user = $userRepository->findById($userEntity->getId());
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
    $user = $userRepository->findById($userEntity->getId());
    expect($user)->toBeInstanceOf(UserEntity::class);
    expect($user->getUuid()->getValue())->toEqual($uuid);
    expect($user->getName())->toEqual('John Doe');

    $userUseCase = new UpdateUserUseCase($userRepository);
    $updateUserDTO = (new UserDTO(uuid: $user->getUuid()->getValue()))
        ->setId($userEntity->getId())
        ->setName('Foo Bar')
        ->setEmail('abcd@example.com');
    $userUseCase->execute($updateUserDTO);
    $user = $userRepository->findById($user->getId());
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
    $userDTO->setId($userEntity->getId());
    $user = $userRepository->findById($userEntity->getId());
    expect($user)->toBeInstanceOf(UserEntity::class);

    $deleteUserUseCase = new DeleteUserUseCase($userRepository);
    $deleteUserUseCase->execute($userEntity->getId());
    $findFunction = fn () => ($userRepository->findById($userEntity->getId()));
    expect($findFunction)->toThrow(ResourceNotFountException::class, "User not found [{$userEntity->getId()}]");
});
