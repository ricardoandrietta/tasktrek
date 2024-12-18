<?php

declare(strict_types=1);

namespace TaskTrek\Core\Domain\User;

use TaskTrek\Core\Domain\ValueObjects\Email;
use TaskTrek\Core\Domain\ValueObjects\UUIDv4;

class UserEntity
{
    public const string DEFAULT_LANGUAGE = 'en';
    public const string DEFAULT_TIMEZONE = 'UTC';
    protected ?int $userId = null;
    protected string $timezone = self::DEFAULT_TIMEZONE;
    protected string $language = self::DEFAULT_LANGUAGE;

    public function __construct(
        protected UUIDv4 $uuid,
        protected Email $email,
        protected string $name,
    ) {
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
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
     * @return UUIDv4
     */
    public function getUuid(): UUIDv4
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
     * @return UserEntity
     */
    public function setLanguage(string $language): UserEntity
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
     * @return UserEntity
     */
    public function setTimezone(string $timezone): UserEntity
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     *
     * @return UserEntity
     */
    public function setUserId(?int $userId): UserEntity
    {
        $this->userId = $userId;
        return $this;
    }
}
