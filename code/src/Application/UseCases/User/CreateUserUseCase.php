<?php

declare(strict_types=1);

namespace TaskTrek\Application\UseCases\User;

use TaskTrek\Application\DTOs\UserDTO;
use TaskTrek\Domain\User\UserEntity;
use TaskTrek\Domain\ValueObjects\Email;
use TaskTrek\Domain\ValueObjects\UUIDv4;
use TaskTrek\Infra\Repositories\UserRepositoryInterface;

readonly class CreateUserUseCase
{
    public function __construct(private UserDTO $user, private UserRepositoryInterface $repository)
    {
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $uuid = new UUIDv4($this->user->uuid);
        if (!$uuid->isValid()) {
            throw new \InvalidArgumentException('Invalid UUID');
        }
        $email = new Email($this->user->email);
        if (!$email->isValid()) {
            throw new \InvalidArgumentException('Invalid email');
        }
        $userEntity = (new UserEntity(
            $uuid,
            $email,
            $this->user->name
        ))
            ->setLanguage($this->user->language)
            ->setTimezone($this->user->timezone);
        try {
            $this->repository->create($userEntity);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
