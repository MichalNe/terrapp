<?php
declare(strict_types=1);

namespace App\Auth\Application;

use App\Auth\Application\Command\DataToCreateUser;
use App\Auth\Application\Exception\UserAlreadyExistsException;
use App\Auth\DomainModel\AuthCredentials;
use App\Auth\DomainModel\AuthRepository;
use App\Auth\ReadModel\Query\DataToFindUser;

class AuthService
{
    public function __construct(
        private AuthRepository $authRepository,
    ) {
    }

    public function createUser(DataToCreateUser $command): void
    {
        $user = $this->authRepository->findUser(
            new DataToFindUser($command->getEmail(), $command->getPassword())
        );

        if ($user !== null) {
            throw UserAlreadyExistsException::create();
        }

        //todo: continue create user
    }
}