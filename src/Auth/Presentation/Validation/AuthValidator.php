<?php
declare(strict_types=1);

namespace App\Auth\Presentation\Validation;

use App\SharedKernel\Validator;
use Symfony\Component\Validator\Constraints as Assert;

class AuthValidator extends Validator
{
    public function validCreateUser(array $data): array
    {
        $constraints = new Assert\Collection([
            'email' => [
                new Assert\NotBlank(allowNull: false),
                new Assert\Email()
            ],
            'password' => [
                new Assert\NotBlank(allowNull: false),
            ]
        ]);

        return $this->validate($data, $constraints);
    }
}