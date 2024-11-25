<?php

declare(strict_types=1);

namespace TaskTrek\Core\Application\UseCases\User;

use TaskTrek\Core\Domain\Auth\UserRegistrationServiceInterface;
use TaskTrek\Core\Domain\User\UserEntity;

class RegisterUserUseCase
{
    private UserRegistrationServiceInterface $registrationService;

    public function __construct(UserRegistrationServiceInterface $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function execute(string $email, string $password): UserEntity
    {
        // You might want to add validation here
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email format');
        }

        if (strlen($password) < 8) {
            throw new \InvalidArgumentException('Password must be at least 8 characters');
        }

        return $this->registrationService->register($email, $password);
    }
}
