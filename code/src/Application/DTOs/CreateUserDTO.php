<?php

declare(strict_types=1);

namespace TaskTrek\Core\Application\DTOs;

class CreateUserDTO extends UserDTO
{
    public function __construct(
        public string $uuid,
        public string $email,
        public string $name
    ) {
        parent::__construct($uuid);
    }
}
