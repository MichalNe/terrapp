<?php
declare(strict_types=1);

namespace App\SharedKernel;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CustomAbstractController extends AbstractController
{
    public function responseException(NamedErrorException $e): Response
    {
        return new Response(
            json_encode([
                'errorName' => $e->getErrorName(),
                'errorCode' => $e->getCode(),
            ]),
            Response::HTTP_BAD_REQUEST
        );
    }

    /*public function present(Present $present): Response
    {

    }*/
}