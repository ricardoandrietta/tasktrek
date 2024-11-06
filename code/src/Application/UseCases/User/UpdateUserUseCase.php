<?php

declare(strict_types=1);

namespace TaskTrek\Application\UseCases\User;

use TaskTrek\Application\DTOs\UserDTO;
use TaskTrek\Application\Exceptions\ResourceNotFountException;
use TaskTrek\Domain\User\UserEntity;
use TaskTrek\Domain\ValueObjects\Email;
use TaskTrek\Domain\ValueObjects\UUIDv4;
use TaskTrek\Infra\Repositories\UserRepositoryInterface;

readonly class UpdateUserUseCase
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * @param UserDTO $user
     *
     * @return void
     * @throws ResourceNotFountException
     */
    public function execute(UserDTO $user): void
    {
        if ($user->getId() === null) {
            throw new \InvalidArgumentException('Id is required');
        }

        $uuid = new UUIDv4($user->uuid);
        if (!$uuid->isValid()) {
            throw new \InvalidArgumentException('Invalid UUID');
        }

        $userEntity = $this->repository->findById($user->getId());
        if (!$userEntity) {
            throw new ResourceNotFountException("User not found [{$user->getId()}]");
        }

        $email = $userEntity->getEmail();
        if (!empty($user->email)) {
            $email = new Email($user->email);
            if (!$email->isValid()) {
                throw new \InvalidArgumentException('Invalid email');
            }
        }
        $userEntity = (new UserEntity(
            $uuid,
            $email,
            $user->name
        ))
            ->setId($user->getId())
            ->setLanguage($user->language)
            ->setTimezone($user->timezone);
        try {
            $this->repository->update($userEntity);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage() . " " . $e->getFile() . " " . $e->getLine());
        }
    }
}
