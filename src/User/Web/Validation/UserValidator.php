<?php
declare(strict_types=1);

namespace App\User\Web\Validation;

use App\Shared\Validator\Validator;
use Symfony\Component\Validator\Constraints as Assert;

class UserValidator extends Validator
{
    public function validUser(array $data): array
    {
        $constraints = new Assert\Collection([
            'email' => [
                new Assert\NotBlank(),
                new Assert\NotNull(),
                new Assert\Email(),
            ],
            'password' => [
                new Assert\NotBlank(),
                new Assert\NotNull(),
            ]
        ]);

        return $this->validate($data, $constraints);
    }
}