<?php

namespace TaskTrek\Core\Domain\Auth;

use TaskTrek\Core\Domain\User\UserEntity;

interface UserRegistrationServiceInterface
{
    public function register(string $email, string $password): UserEntity;
}
