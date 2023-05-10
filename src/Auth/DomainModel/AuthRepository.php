<?php
declare(strict_types=1);

namespace App\Auth\DomainModel;

use App\Auth\DomainModel\Exception\UserNotCreatedException;
use App\Auth\DomainModel\Exception\UserNotFoundException;
use App\Auth\ReadModel\Query\DataToFindUser;

interface AuthRepository
{
    public function findUser(DataToFindUser $query): ?AuthCredentials;

    /**
     * @throws UserNotFoundException
     */
    public function getUser(DataToFindUser $query): AuthCredentials;

    /**
     * @throws UserNotCreatedException
     */
    public function saveUser(AuthCredentials $authCredentials): void;
}