<?php

namespace TaskTrek\Tests\Feature;

use TaskTrek\Core\Application\DTOs\ProjectDTO;
use TaskTrek\Core\Application\Exceptions\ResourceNotFountException;
use TaskTrek\Core\Application\UseCases\Project\CreateProjectUseCase;
use TaskTrek\Core\Application\DTOs\CreateUserDTO;
use TaskTrek\Core\Application\UseCases\Project\DeleteProjectUseCase;
use TaskTrek\Core\Application\UseCases\Project\UpdateProjectUseCase;
use TaskTrek\Core\Application\UseCases\User\CreateUserUseCase;
use TaskTrek\Core\Domain\Project\ProjectEntity;
use TaskTrek\Core\Domain\ValueObjects\UUIDv4;
use TaskTrek\Tests\TestRepositories\ProjectTestRepository;
use TaskTrek\Tests\TestRepositories\UserTestRepository;

it('should create a project', function () {
    $userRepository = new UserTestRepository();
    $userUseCase = new CreateUserUseCase($userRepository);
    $userUUID = UUIDv4::generate();
    expect($userUUID)->toBeUuid();
    $userDTO = new CreateUserDTO(
        uuid: $userUUID,
        email: 'YnQp3@example.com',
        name: 'John Doe'
    );
    $userEntity = $userUseCase->execute($userDTO);

    $projectRepository = new ProjectTestRepository();
    $projectUseCase = new CreateProjectUseCase($projectRepository);
    $projectUUID = UUIDv4::generate();
    $projectDTO = new ProjectDTO(
        uuid: $projectUUID,
        user_id: $userEntity->getUserId(),
        name: 'My Project'
    );
    $projectEntity = $projectUseCase->execute($projectDTO);
    expect($projectEntity->getProjectId())->toBeInt();
    $project = $projectRepository->findById($projectEntity->getProjectId());
    expect($project)->toBeInstanceOf(ProjectEntity::class);
    expect($project->getUuid()->getValue())->toEqual($projectUUID);
});

it('should update a project', function () {
    $userRepository = new UserTestRepository();
    $userUseCase = new CreateUserUseCase($userRepository);
    $userUUID = UUIDv4::generate();
    expect($userUUID)->toBeUuid();
    $userDTO = new CreateUserDTO(
        uuid: $userUUID,
        email: 'YnQp3@example.com',
        name: 'John Doe'
    );
    $userEntity = $userUseCase->execute($userDTO);

    $projectRepository = new ProjectTestRepository();
    $projectUseCase = new CreateProjectUseCase($projectRepository);
    $projectUUID = UUIDv4::generate();
    $projectDTO = new ProjectDTO(
        uuid: $projectUUID,
        user_id: $userEntity->getUserId(),
        name: 'My Project'
    );
    $projectEntity = $projectUseCase->execute($projectDTO);

    $updateProjectUseCase = new UpdateProjectUseCase($projectRepository);
    $updatedProjectDTO = new ProjectDTO(
        uuid: $projectEntity->getUuid()->getValue(),
        user_id: $projectEntity->getUserId(),
        name: 'My Project Fixed'
    );
    $updatedProjectDTO
        ->setProjectId($projectEntity->getProjectId())
        ->setDescription('My Project Description')
        ->setDueDate('2029-01-01 00:00:00');

    $updateProjectUseCase->execute($updatedProjectDTO);
    $updatedProjectEntity = $projectRepository->findById($projectEntity->getProjectId());
    expect($updatedProjectEntity)->toBeInstanceOf(ProjectEntity::class);
    expect($updatedProjectEntity->getProjectId())->toBeInt();

    $project = $projectRepository->findById($updatedProjectEntity->getProjectId());
    expect($project)->toBeInstanceOf(ProjectEntity::class);
    expect($project->getUuid()->getValue())->toEqual($projectUUID);
    expect($project->getName())->toEqual('My Project Fixed');
    expect($project->getDescription())->toEqual('My Project Description');
    expect($project->getDueDate()?->format('Y-m-d H:i:s'))->toEqual('2029-01-01 00:00:00');
});

it('should delete a project', function () {
    $userRepository = new UserTestRepository();
    $userUseCase = new CreateUserUseCase($userRepository);
    $userUUID = UUIDv4::generate();
    expect($userUUID)->toBeUuid();
    $userDTO = new CreateUserDTO(
        uuid: $userUUID,
        email: 'YnQp3@example.com',
        name: 'John Doe'
    );
    $userEntity = $userUseCase->execute($userDTO);

    $projectRepository = new ProjectTestRepository();
    $projectUseCase = new CreateProjectUseCase($projectRepository);
    $projectUUID = UUIDv4::generate();
    $projectDTO = new ProjectDTO(
        uuid: $projectUUID,
        user_id: $userEntity->getUserId(),
        name: 'My Project'
    );
    $projectEntity = $projectUseCase->execute($projectDTO);

    $deleteProjectUseCase = new DeleteProjectUseCase($projectRepository);
    $deleteProjectUseCase->execute($projectEntity->getProjectId());
    $findFunction = fn () => ($projectRepository->findById($projectEntity->getProjectId()));
    expect($findFunction)->toThrow(ResourceNotFountException::class, "Project not found [{$projectEntity->getProjectId()}]");
});
