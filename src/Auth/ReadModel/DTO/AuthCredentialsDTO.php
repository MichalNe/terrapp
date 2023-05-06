<?php
declare(strict_types=1);

namespace App\Auth\ReadModel\DTO;

use DateTime;

class AuthCredentialsDTO
{
    public function __construct(
        private string $email,
        private string $password,
        private array $roles,
        private string $token,
        private DateTime $createdAt,
        private ?DateTime $updatedAt,
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