<?php
declare(strict_types=1);

namespace App\Shared\Controller;

use App\Shared\Exception\NamedErrorException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class CustomAbstractController extends AbstractController
{
    public function responseException(NamedErrorException $e): JsonResponse
    {
        return new JsonResponse(
            [
                'errorName' => $e->getErrorName(),
                'errorCode' => $e->getCode(),
            ],
            Response::HTTP_BAD_REQUEST
        );
    }

    /*public function present(Present $present): Response
    {

    }*/
}