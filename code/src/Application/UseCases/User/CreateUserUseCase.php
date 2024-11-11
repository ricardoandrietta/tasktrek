<?php

declare(strict_types=1);

namespace TaskTrek\Core\Application\UseCases\User;

use TaskTrek\Core\Application\DTOs\CreateUserDTO;
use TaskTrek\Core\Domain\User\UserEntity;
use TaskTrek\Core\Domain\ValueObjects\Email;
use TaskTrek\Core\Domain\ValueObjects\UUIDv4;
use TaskTrek\Core\Infra\Repositories\UserRepositoryInterface;

readonly class CreateUserUseCase
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    /**
     * @param CreateUserDTO $user
     *
     * @return UserEntity
     */
    public function execute(CreateUserDTO $user): UserEntity
    {
        $uuid = new UUIDv4($user->uuid);
        if (!$uuid->isValid()) {
            throw new \InvalidArgumentException('Invalid UUID');
        }
        $email = new Email($user->email);
        if (!$email->isValid()) {
            throw new \InvalidArgumentException('Invalid email');
        }
        $userEntity = (new UserEntity(
            $uuid,
            $email,
            $user->name
        ))
            ->setLanguage($user->language)
            ->setTimezone($user->timezone);
        try {
            $userId = $this->userRepository->create($userEntity);
            $userEntity->setUserId($userId);
            return $userEntity;
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
