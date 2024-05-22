<?php

namespace App\EventListener;

use App\Entity\Session;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AuthenticationListener
{ // TODO HACER LO DE LA SESSION QUE SE INYECTE EL ROUTER Y PONERLO EN EL SESSIONCONTROLLER COMO UN ATRIBUTO PRIVADO, CON ESO ESTARÍA LA REDIRECCIÒN, LO PRÓXIMO EL LOGIN Y YA LOS DATOS
    private $urlGenerator;
    private $session;
    private $entityManager;

    public function __construct(UrlGeneratorInterface $urlGenerator, SessionService $session, EntityManagerInterface $entityManager)
    {
        $this->urlGenerator = $urlGenerator;
        $this->session = $session;
        $this->entityManager = $entityManager;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        $route = $request->attributes->get('_route');

        $isLogged = $this->session->has('username');

        // $users = $this->entityManager->getRepository(Session::class)->findAll();

        if (!$isLogged && $route !== 'login' && $route !== 'checkUser') {
            $response = new RedirectResponse($this->urlGenerator->generate('login'));

            $event->setResponse($response);
        }
    }
}