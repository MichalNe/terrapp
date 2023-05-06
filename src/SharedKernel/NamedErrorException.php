<?php
declare(strict_types=1);

namespace App\SharedKernel;

use Exception;

abstract class NamedErrorException extends Exception
{
    public function getErrorName(): string
    {
        return "API request error";
    }
}