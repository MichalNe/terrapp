<?php
declare(strict_types=1);

namespace App\Auth\ReadModel\Exception;

use App\Auth\SharedKernel\AuthException;

class UserNotExistsException extends AuthException
{
    public static function create(): self
    {
        return new self(self::USER_NOT_EXISTS, self::USER_NOT_EXISTS_CODE);
    }

    public function getErrorName(): string
    {
        return self::USER_NOT_EXISTS;
    }
}