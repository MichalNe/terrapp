<?php
declare(strict_types=1);

namespace App\Animal\Web\Validation;
use Symfony\Component\Validator\Constraints as Assert;

use App\Shared\Validator\Validator;

class AnimalValidator extends Validator
{
    public function validAnimal(array $data): array
    {
        $constraints = new Assert\Collection([
            'name' => new Assert\NotBlank(),
            'userId' => new Assert\NotBlank(),
            'description' => new Assert\NotNull()
        ]);

        return $this->validate($data, $constraints);
    }
}