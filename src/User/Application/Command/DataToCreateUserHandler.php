<?php
declare(strict_types=1);

namespace App\User\Application\Command;

use App\Shared\Command\CommandHandler;
use App\User\Application\UserService;

class DataToCreateUserHandler implements CommandHandler
{
    public function __construct(
        private UserService $userService,
    ) {
    }

    public function __invoke(DataToCreateUser $command): void
    {
        $this->userService->createUser($command->getEmail(), $command->getPassword());
    }
}