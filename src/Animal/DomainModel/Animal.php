<?php
declare(strict_types=1);

namespace App\Animal\DomainModel;

use DateTime;

class Animal
{
    public function __construct(
        private ?int $id,
        private int $userId,
        private string $name,
        private string $description,
        private DateTime $createdAt,
        private ?DateTime $updatedAt = null,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
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