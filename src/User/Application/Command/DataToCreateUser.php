<?php
declare(strict_types=1);

namespace App\User\Application\Command;

use App\Shared\Command\Command;

class DataToCreateUser implements Command
{
    public function __construct(
        private string $email,
        private string $password,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}