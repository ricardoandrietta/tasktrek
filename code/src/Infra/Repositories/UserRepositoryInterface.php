<?php

namespace TaskTrek\Infra\Repositories;

use TaskTrek\Domain\User\UserEntity;
use TaskTrek\Domain\ValueObjects\UUIDv4;

interface UserRepositoryInterface
{
    public function create(UserEntity $user): int;
    public function update(UserEntity $user): void;
    public function delete(int $userId): void;
    public function findById(int $userId): ?UserEntity;
}
