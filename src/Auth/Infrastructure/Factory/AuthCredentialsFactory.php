<?php
declare(strict_types=1);

namespace App\Auth\Infrastructure\Factory;

use App\Auth\DomainModel\AuthCredentials;
use App\Entity\User;
use DateTime;

class AuthCredentialsFactory
{
    /**
     * @throws \Exception
     */
    public static function createFromEntity(User $user): AuthCredentials
    {
        return new AuthCredentials(
            $user->getEmail(),
            $user->getPassword(),
            $user->getRoles(),
            $user->getCreatedAt(),
            $user->getUpdatedAt(),
        );
    }
}