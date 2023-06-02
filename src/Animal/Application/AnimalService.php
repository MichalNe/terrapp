<?php
declare(strict_types=1);

namespace App\Animal\Application;

use App\Animal\Application\Command\DataToCreateAnimal;
use App\Animal\Application\Exception\AnimalNotCreatedException;
use App\Animal\DomainModel\Animal;
use App\Animal\DomainModel\AnimalRepository;
use App\Animal\DomainModel\Exception\AnimalCreateException;
use DateTime;

class AnimalService
{
    public function __construct(
        private AnimalRepository $animalRepository,
    ) {
    }

    /**
     * @throws AnimalNotCreatedException
     */
    public function createAnimal(DataToCreateAnimal $command): void
    {
        try {
            $animal = new Animal(
                id: null,
                userId: $command->getUserId(),
                name: $command->getName(),
                description: $command->getDescription(),
                createdAt: new DateTime('now')
            );

            $this->animalRepository->createAnimal($animal);
        } catch (AnimalCreateException $e) {
            throw AnimalNotCreatedException::create();
        }
    }
}