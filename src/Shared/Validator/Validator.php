<?php
declare(strict_types=1);

namespace App\Shared\Validator;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class Validator
{
    public function __construct(
        private ValidatorInterface $validator,
    ) {}

    public function validate(array $data, Assert\Collection $constraints): array
    {
        $validatorErrors = $this->validator->validate($data, $constraints);

        $errors = [];

        foreach ($validatorErrors as $error) {
            $errors[] = [
                'message' => $error->getMessage(),
                'field' => $error->getPropertyPath(),
            ];
        }

        return $errors;
    }
}