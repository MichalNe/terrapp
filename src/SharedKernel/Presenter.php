<?php
declare(strict_types=1);

namespace App\SharedKernel;

interface Presenter
{
     public function present(): array;
}