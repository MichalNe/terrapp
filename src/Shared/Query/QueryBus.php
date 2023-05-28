<?php
declare(strict_types=1);

namespace App\Shared\Query;

interface QueryBus
{
    /** @return mixed */
    public function handle(Query $query);
}