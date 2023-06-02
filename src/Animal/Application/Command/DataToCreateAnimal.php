<?php
declare(strict_types=1);

namespace App\Animal\Application\Command;

use App\Shared\Command\Command;

class DataToCreateAnimal implements Command
{
    public function __construct(
        private int $userId,
        private string $name,
        private ?string $description,
    ) {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}