<?php
declare(strict_types=1);

namespace App\Shared\Query;

use Symfony\Component\Messenger\HandleTrait;

class MessageQueryBus implements QueryBus
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct()
    {
    }

    public function handle(Query $query)
    {
        $this->handleQuery($query);
    }
}