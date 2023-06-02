<?php
declare(strict_types=1);

namespace App\Animal\Shared;

use App\Shared\Exception\NamedErrorException;

class AnimalException extends NamedErrorException
{
    public const ANIMAL_NOT_CREATED = 'animal.notCreated';
    public const ANIMAL_NOT_CREATED_CODE = 2000;

}