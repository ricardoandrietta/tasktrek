<?php

declare(strict_types=1);

namespace TaskTrek\Application\UseCases\User;

use TaskTrek\Application\DTOs\UserDTO;
use TaskTrek\Domain\User\UserEntity;
use TaskTrek\Domain\ValueObjects\Email;
use TaskTrek\Domain\ValueObjects\UUIDv4;
use TaskTrek\Infra\Repositories\UserRepositoryInterface;

readonly class DeleteUserUseCase
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * @param UUIDv4 $userId
     *
     * @return void
     */
    public function execute(UUIDv4 $userId): void
    {
        try {
            $this->repository->delete($userId);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
