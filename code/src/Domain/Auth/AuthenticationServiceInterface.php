<?php

namespace TaskTrek\Core\Domain\Auth;

use TaskTrek\Core\Domain\User\UserEntity;

interface AuthenticationServiceInterface
{
    public function authenticate(string $email, string $password): ?UserEntity;
    public function hashPassword(string $password): string;
    public function verifyPassword(string $hashedPassword, string $password): bool;
}
