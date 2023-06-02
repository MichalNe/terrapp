<?php
declare(strict_types=1);

namespace App\User\Application\Listener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

#[AsEventListener]
class AuthenticationListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            'lexik_jwt_authentication.on_authentication_failure' => 'onAuthenticationFailure',
            'lexik_jwt_authentication.on_jwt_not_found' => 'onJwtNotFound',
            'lexik_jwt_authentication.on_jwt_invalid' => 'onInvalidJwtToken',
            'lexik_jwt_authentication.on_jwt_expired' => 'onExpiredJwtToken',
        ];
    }

    public function onAuthenticationFailure(AuthenticationFailureEvent $event): void
    {
        $event->setResponse(new JsonResponse('Invalid credentials.', JsonResponse::HTTP_UNAUTHORIZED));
    }

    public function onJwtNotFound(JWTNotFoundEvent $event): void
    {
        $event->setResponse(new JsonResponse('Invalid credentials.', JsonResponse::HTTP_UNAUTHORIZED));
    }

    public function onInvalidJwtToken(JWTInvalidEvent $event): void
    {
        $event->setResponse(new JsonResponse('Invalid token. Check token.', JsonResponse::HTTP_UNAUTHORIZED));
    }

    public function onExpiredJwtToken(JWTExpiredEvent $event): void
    {
        $event->setResponse(new JsonResponse('Expired token. Login again.', JsonResponse::HTTP_UNAUTHORIZED));
    }
}