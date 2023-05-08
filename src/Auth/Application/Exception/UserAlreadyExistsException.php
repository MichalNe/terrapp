<?php
declare(strict_types=1);

namespace App\Auth\Application\Exception;

use App\Auth\SharedKernel\AuthException;

class UserAlreadyExistsException extends AuthException
{
    public static function create(): self
    {
        return new self(self::USER_ALREADY_EXISTS, self::USER_ALREADY_EXISTS_CODE);
    }

    public function getErrorName(): string
    {
        return self::USER_ALREADY_EXISTS;
    }
}