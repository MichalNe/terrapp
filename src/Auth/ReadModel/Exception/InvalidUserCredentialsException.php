<?php
declare(strict_types=1);

namespace App\Auth\ReadModel\Exception;

use App\Auth\SharedKernel\AuthException;

class InvalidUserCredentialsException extends AuthException
{
    public static function create(): self
    {
        return new self(self::INVALID_USER_CREDENTIALS, self::INVALID_USER_CREDENTIALS_CODE);
    }

    public function getErrorName(): string
    {
        return self::INVALID_USER_CREDENTIALS;
    }
}