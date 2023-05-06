<?php
declare(strict_types=1);

namespace App\Auth\Presentation;

use App\Auth\ReadModel\DTO\AuthCredentialsDTO;
use App\SharedKernel\Presenter;

class AuthPresenter implements Presenter
{
    public function __construct(
        private readonly AuthCredentialsDTO $authCredentialsDTO,
    ) {
    }

    public function present(): array
    {
        return [
            'email' => $this->authCredentialsDTO->getEmail(),
            'token' => $this->authCredentialsDTO->getToken(),
        ];
    }
}