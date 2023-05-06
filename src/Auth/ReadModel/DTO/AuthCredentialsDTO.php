<?php
declare(strict_types=1);

namespace App\Auth\ReadModel\DTO;

use DateTime;

class AuthCredentialsDTO
{
    public function __construct(
        private readonly string $email,
        private readonly string $password,
        private readonly array $roles,
        private readonly string $token,
        private readonly DateTime $createdAt,
        private readonly ?DateTime $updatedAt,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }
}