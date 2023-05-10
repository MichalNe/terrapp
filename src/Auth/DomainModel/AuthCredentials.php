<?php
declare(strict_types=1);

namespace App\Auth\DomainModel;

use App\Entity\User;
use DateTime;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthCredentials extends User implements PasswordAuthenticatedUserInterface, UserInterface
{
    public const DEFAULT_ROLES = ['ROLE_USER'];

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
        return $this->password === hash('sha256', $plainPassword);
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public static function hashPassword(string $plainPassword): string
    {
        return hash('sha256', $plainPassword);
    }
}