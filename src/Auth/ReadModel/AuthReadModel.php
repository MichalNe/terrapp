<?php
declare(strict_types=1);

namespace App\Auth\ReadModel;

use App\Auth\DomainModel\AuthRepository;
use App\Auth\DomainModel\Exception\UserNotFoundException;
use App\Auth\ReadModel\DTO\AuthCredentialsDTO;
use App\Auth\ReadModel\Exception\UserNotExistsException;
use App\Auth\ReadModel\Query\DataToFindUser;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthReadModel
{
    public function __construct(
        private AuthRepository $authRepository,
        private JWTTokenManagerInterface $JWTTokenManager,
    ) {
    }

    /**
     * @throws UserNotExistsException
     */
    public function getUser(DataToFindUser $query): AuthCredentialsDTO
    {
        try {
            $user = $this->authRepository->getUser($query);

            if ($user->isPasswordValid($query->getPassword())) {
                return new AuthCredentialsDTO(
                    $user->getEmail(),
                    $user->getPassword(),
                    $user->getRoles(),
                    $this->JWTTokenManager->create($user),
                    $user->getCreatedAt(),
                    $user->getUpdatedAt(),
                );
            }
        } catch (UserNotFoundException $e) {
            throw UserNotExistsException::create();
        }
    }
}