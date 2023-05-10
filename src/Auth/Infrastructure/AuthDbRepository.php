<?php
declare(strict_types=1);

namespace App\Auth\Infrastructure;

use App\Auth\DomainModel\AuthCredentials;
use App\Auth\DomainModel\AuthRepository;
use App\Auth\DomainModel\Exception\UserNotCreatedException;
use App\Auth\DomainModel\Exception\UserNotFoundException;
use App\Auth\Infrastructure\Factory\AuthCredentialsFactory;
use App\Auth\ReadModel\Query\DataToFindUser;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception;
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

    /**
     * @throws UserNotCreatedException
     */
    public function saveUser(AuthCredentials $authCredentials): void
    {
        try {
            $qb = $this->entityManager->getConnection();

            $sql = "INSERT INTO user (email, password, roles, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";

            $qb->executeQuery(
                $sql,
                [
                    $authCredentials->getEmail(),
                    $authCredentials->getPassword(),
                    json_encode($authCredentials->getRoles()),
                    ($authCredentials->getCreatedAt())->format('Y-m-d H:i:s'),
                    $authCredentials->getUpdatedAt(),
                ]
            );
        } catch (Exception $e) {
            throw new UserNotCreatedException();
        }
    }
}