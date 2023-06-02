<?php
declare(strict_types=1);

namespace App\Animal\Application\Controller;

use App\Animal\Application\AnimalService;
use App\Animal\Application\Command\DataToCreateAnimal;
use App\Animal\Application\Exception\AnimalNotCreatedException;
use App\Animal\Web\Validation\AnimalValidator;
use App\Shared\Controller\CustomAbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/animal')]
class AnimalController extends CustomAbstractController
{
    #[Route('/create', 'animal_create', methods: ['POST'])]
    public function create(
        Request $request,
        ValidatorInterface $validator,
        AnimalService $animalService,
    ): JsonResponse {
        try {
            $decodedData = json_decode($request->getContent(), true);

            $errors = (new AnimalValidator($validator))->validAnimal($decodedData);

            if ($errors !== []) {
                return new JsonResponse($errors, Response::HTTP_BAD_REQUEST);
            }

            $animalService->createAnimal(
                new DataToCreateAnimal($decodedData['userId'], $decodedData['name'], $decodedData['description'])
            );

            return new JsonResponse();
        } catch (AnimalNotCreatedException $e) {
            return $this->responseException($e);
        }
    }
}