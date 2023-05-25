<?php
declare(strict_types=1);

namespace App\Auth\DomainModel;

use DateTime;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthCredentials implements PasswordAuthenticatedUserInterface, UserInterface
{
    public function __construct(
        private readonly string $email,
        private readonly ?string $password = null,
        private readonly ?array $roles = [],
        private readonly ?DateTime $createdAt = null,
        private readonly ?DateTime $updatedAt = null,
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

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function isPasswordValid(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->password);
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}