<?php
declare(strict_types=1);

namespace App\Auth\Application;

use App\Auth\Application\Command\DataToCreateUser;
use App\Auth\Application\Exception\UserAlreadyExistsException;
use App\Auth\Application\Exception\UserNotCreated;
use App\Auth\DomainModel\AuthCredentials;
use App\Auth\DomainModel\AuthRepository;
use App\Auth\DomainModel\Exception\UserNotCreatedException;
use App\Auth\ReadModel\Query\DataToFindUser;
use DateTime;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class AuthService
{
    public function __construct(
        private AuthRepository $authRepository,
    ) {
    }

    /**
     * @throws UserAlreadyExistsException
     * @throws UserNotCreated
     */
    public function createUser(DataToCreateUser $command): void
    {
        try {
            $user = $this->authRepository->findUser(
                new DataToFindUser($command->getEmail(), $command->getPassword())
            );

            if ($user !== null) {
                throw UserAlreadyExistsException::create();
            }

            $this->authRepository->saveUser(
                new AuthCredentials(
                    $command->getEmail(),
                    AuthCredentials::hashPassword($command->getPassword()),
                    AuthCredentials::DEFAULT_ROLES,
                    new DateTime('now'),
                )
            );
        } catch (UserNotCreatedException $e) {
            throw UserNotCreated::create();
        }
    }
}