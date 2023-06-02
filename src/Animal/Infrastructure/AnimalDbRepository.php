<?php
declare(strict_types=1);

namespace App\Animal\Infrastructure;

use App\Animal\DomainModel\Animal;
use App\Animal\DomainModel\AnimalRepository;
use App\Animal\DomainModel\Exception\AnimalCreateException;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;

class AnimalDbRepository implements AnimalRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @throws AnimalCreateException
     */
    public function createAnimal(Animal $animal): void
    {
        try {
            $sql = "INSERT INTO animal (user_id, name, description, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
            $query = $this->entityManager->getConnection()->prepare($sql);

            $query->executeQuery([
                $animal->getUserId(),
                $animal->getName(),
                $animal->getDescription(),
                $animal->getCreatedAt()->format('Y-m-d H:i:s'),
                $animal->getUpdatedAt()?->format('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
            throw new AnimalCreateException();
        }
    }
}