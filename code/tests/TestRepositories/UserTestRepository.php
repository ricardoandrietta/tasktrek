<?php

declare(strict_types=1);

namespace TaskTrek\Tests\TestRepositories;

use TaskTrek\Core\Application\Exceptions\ResourceNotFountException;
use TaskTrek\Core\Domain\User\UserEntity;
use TaskTrek\Core\Infra\Repositories\UserRepositoryInterface;

class UserTestRepository implements UserRepositoryInterface
{
    public array $users = [];
    public function create(UserEntity $user): int
    {
        $i = count($this->users);
        $user->setUserId($i);
        $this->users[$i] = $user;
        return $i;
    }

    /**
     * @throws ResourceNotFountException
     */
    public function update(UserEntity $user): void
    {
        if (isset($this->users[$user->getUserId()])) {
            $this->users[$user->getUserId()] = $user;
        } else {
            throw new ResourceNotFountException("User not found [{$user->getUserId()}] - " . json_encode($this->users));
        }
    }

    public function delete(int $userId): void
    {
        if (isset($this->users[$userId])) {
            unset($this->users[$userId]);
        }
    }

    /**
     * @param int $userId
     *
     * @return UserEntity|null
     * @throws ResourceNotFountException
     */
    public function findById(int $userId): ?UserEntity
    {
        if (isset($this->users[$userId])) {
            return $this->users[$userId];
        }

        throw new ResourceNotFountException("User not found [{$userId}]");
    }
}
