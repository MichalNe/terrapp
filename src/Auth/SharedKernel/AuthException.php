<?php
declare(strict_types=1);

namespace App\Auth\SharedKernel;

use App\SharedKernel\NamedErrorException;

class AuthException extends NamedErrorException
{
    public const USER_NOT_EXISTS = 'auth.userNotExists';
    public const USER_NOT_EXISTS_CODE = 2001;
    public const USER_ALREADY_EXISTS = 'auth.userAlreadyExists';
    public const USER_ALREADY_EXISTS_CODE = 2002;
    public const INVALID_USER_CREDENTIALS = 'auth.invalidUserCredentials';
    public const INVALID_USER_CREDENTIALS_CODE = 2003;
    public const USER_NOT_CREATED = 'auth.userNotCreated';
    public const USER_NOT_CREATED_CODE = 2004;
}