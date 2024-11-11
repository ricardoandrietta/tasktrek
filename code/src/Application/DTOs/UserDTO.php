<?php

declare(strict_types=1);

namespace TaskTrek\Core\Application\DTOs;

use TaskTrek\Core\Domain\User\UserEntity;

class UserDTO
{
    public ?int $user_id = null;
    public string $email = '';
    public string $name = '';
    public string $timezone = UserEntity::DEFAULT_TIMEZONE;
    public string $language = UserEntity::DEFAULT_LANGUAGE;

    public function __construct(
        public string $uuid,
    ) {
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     *
     * @return UserDTO
     */
    public function setUserId(?int $user_id): UserDTO
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @param string $email
     *
     * @return UserDTO
     */
    public function setEmail(string $email): UserDTO
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $name
     *
     * @return UserDTO
     */
    public function setName(string $name): UserDTO
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @return UserDTO
     */
    public function setLanguage(string $language): UserDTO
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     *
     * @return UserDTO
     */
    public function setTimezone(string $timezone): UserDTO
    {
        $this->timezone = $timezone;
        return $this;
    }
}
