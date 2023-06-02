<?php
declare(strict_types=1);

namespace App\Animal\DomainModel;

use App\Animal\DomainModel\Exception\AnimalCreateException;

interface AnimalRepository
{
    /**
     * @throws AnimalCreateException
     */
    public function createAnimal(Animal $animal): void;
}