<?php
declare(strict_types=1);

namespace App\SharedKernel;
use Symfony\Component\HttpFoundation\Response;

abstract class Present
{
    public function present(array $data): Response
    {
        return new Response(json_encode($data), Response::HTTP_OK);
    }
}