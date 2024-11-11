<?php

namespace TaskTrek\Core\Infra\Repositories;

use TaskTrek\Core\Domain\User\UserEntity;

interface UserRepositoryInterface
{
    public function create(UserEntity $user): int;
    public function update(UserEntity $user): void;
    public function delete(int $userId): void;
    public function findById(int $userId): ?UserEntity;
}
