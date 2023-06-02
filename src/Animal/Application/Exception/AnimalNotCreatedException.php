<?php
declare(strict_types=1);

namespace App\Animal\Application\Exception;

use App\Animal\Shared\AnimalException;

class AnimalNotCreatedException extends AnimalException
{
    public static function create(): self
    {
        return new self(self::ANIMAL_NOT_CREATED, self::ANIMAL_NOT_CREATED_CODE);
    }

    public function getErrorName(): string
    {
        return self::ANIMAL_NOT_CREATED;
    }
}