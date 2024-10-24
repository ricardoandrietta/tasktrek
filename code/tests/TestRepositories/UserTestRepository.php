<?php

declare(strict_types=1);

use TaskTrek\Application\Exceptions\ResourceNotFountException;
use TaskTrek\Domain\User\UserEntity;
use TaskTrek\Domain\ValueObjects\UUIDv4;
use TaskTrek\Infra\Repositories\UserRepositoryInterface;

class UserTestRepository implements UserRepositoryInterface
{
    public array $users = [];
    public function create(UserEntity $user): void
    {
        $this->users[$user->getUuid()->getValue()] = $user;
    }

    /**
     * @throws ResourceNotFountException
     */
    public function update(UserEntity $user): void
    {
        if (isset($this->users[$user->getUuid()->getValue()])) {
            $this->users[$user->getUuid()->getValue()] = $user;
        } else {
            throw new ResourceNotFountException("User not found [{$user->getUuid()->getValue()}] - " . json_encode($this->users));
        }
    }

    public function delete(UUIDv4 $userId): void
    {
        if (isset($this->users[$userId->getValue()])) {
            unset($this->users[$userId->getValue()]);
        }
    }

    /**
     * @throws ResourceNotFountException
     */
    public function findById(UUIDv4 $userId): ?UserEntity
    {
        if (isset($this->users[$userId->getValue()])) {
            return $this->users[$userId->getValue()];
        }

        throw new ResourceNotFountException("User not found [{$userId->getValue()}]");
    }
}
