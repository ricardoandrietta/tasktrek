<?php

namespace TaskTrek\Infra\Repositories;

use TaskTrek\Domain\User\UserEntity;
use TaskTrek\Domain\ValueObjects\UUIDv4;

interface UserRepositoryInterface
{
    public function create(UserEntity $user): void;
    public function update(UserEntity $user): void;
    public function delete(UserEntity $user): void;
    public function find(UUIDv4 $uuid): ?UserEntity;
}
