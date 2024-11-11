<?php

declare(strict_types=1);

namespace TaskTrek\Core\Application\UseCases\User;

use TaskTrek\Core\Application\DTOs\UserDTO;
use TaskTrek\Core\Domain\User\UserEntity;
use TaskTrek\Core\Domain\ValueObjects\Email;
use TaskTrek\Core\Domain\ValueObjects\UUIDv4;
use TaskTrek\Core\Infra\Repositories\UserRepositoryInterface;

readonly class DeleteUserUseCase
{
    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * @param int $userId
     *
     * @return void
     */
    public function execute(int $userId): void
    {
        try {
            $this->repository->delete($userId);
        } catch (\Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }
    }
}
