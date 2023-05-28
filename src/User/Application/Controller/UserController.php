<?php

namespace App\User\Application\Controller;

use App\Shared\Command\CommandBus;
use App\Shared\Controller\CustomAbstractController;
use App\User\Application\Command\DataToCreateUser;
use App\User\Web\Validation\UserValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/auth')]
class UserController extends CustomAbstractController
{
    #[Route('/register', name: 'user_register')]
    public function index(Request $request, ValidatorInterface $validator, CommandBus $commandBus): JsonResponse
    {
        $decodedJson = json_decode($request->getContent(), true);

        $errors = (new UserValidator($validator))->validUser($decodedJson);

        if ($errors !== []) {
            return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
        }

        $commandBus->dispatch(
            new DataToCreateUser($decodedJson['email'], $decodedJson['password'])
        );

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }
}
