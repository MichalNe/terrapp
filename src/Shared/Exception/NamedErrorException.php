<?php
declare(strict_types=1);

namespace App\Shared\Exception;

use Exception;

abstract class NamedErrorException extends Exception
{
    public function getErrorName(): string
    {
        return "API request error";
    }
}