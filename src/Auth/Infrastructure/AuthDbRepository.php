<?php
declare(strict_types=1);

namespace App\Auth\Infrastructure;

use App\Auth\DomainModel\AuthCredentials;
use App\Auth\DomainModel\AuthRepository;
use App\Auth\DomainModel\Exception\UserNotFoundException;
use App\Auth\Infrastructure\Factory\AuthCredentialsFactory;
use App\Auth\ReadModel\Query\DataToFindUser;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class AuthDbRepository implements AuthRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserRepository $userRepository,
    ) {
    }

    public function findUser(DataToFindUser $query): ?AuthCredentials
    {
        $user = $this->userRepository->findOneByEmail($query->getEmail());

        if ($user === null) {
            return null;
        }

        return AuthCredentialsFactory::createFromEntity($user);
    }

    /**
     * @throws UserNotFoundException
     */
    public function getUser(DataToFindUser $query): AuthCredentials
    {
        $user = $this->userRepository->findOneByEmail($query->getEmail());

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return AuthCredentialsFactory::createFromEntity($user);
    }
}