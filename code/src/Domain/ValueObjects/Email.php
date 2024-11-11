<?php

declare(strict_types=1);

namespace TaskTrek\Core\Domain\ValueObjects;

readonly class Email
{
    public function __construct(private string $email)
    {
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return (filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->email;
    }

}
