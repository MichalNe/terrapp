<?php
declare(strict_types=1);

namespace App\SharedKernel;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomAbstractController extends AbstractController
{
    public function responseException(NamedErrorException $e): JsonResponse
    {
        return new JsonResponse(
            json_encode([
                'errorName' => $e->getErrorName(),
                'errorCode' => $e->getCode(),
            ]),
            JsonResponse::HTTP_BAD_REQUEST
        );
    }

    public function presentResponse(Presenter $presenter): JsonResponse
    {
        return new JsonResponse($presenter->present(), JsonResponse::HTTP_OK);
    }
}