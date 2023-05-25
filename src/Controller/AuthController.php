<?php
declare(strict_types=1);

namespace App\Controller;

use App\Auth\Presentation\AuthPresenter;
use App\Auth\Presentation\Validation\AuthValidator;
use App\Auth\ReadModel\AuthReadModel;
use App\Auth\ReadModel\Query\DataToFindUser;
use App\Auth\SharedKernel\AuthException;
use App\SharedKernel\CustomAbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends CustomAbstractController
{
    #[
        Route(path: '/auth/login', name: 'auth_login', methods: ['POST'])
    ]
    public function login(
        Request $request,
        AuthReadModel $authReadModel,
        AuthValidator $validator
    ): JsonResponse {
        try {
            $jsonData = json_decode($request->getContent(), true);

            $errors = $validator->validCreateUser($jsonData);

            if ($errors !== []) {
                return new JsonResponse($errors, JsonResponse::HTTP_BAD_REQUEST);
            }

            $user = $authReadModel->getUser(
                new DataToFindUser(
                    $jsonData['email'],
                    $jsonData['password']
                )
            );

            return $this->presentResponse(
                new AuthPresenter($user)
            );
        } catch (AuthException $e) {
            return $this->responseException($e);
        }
    }
}