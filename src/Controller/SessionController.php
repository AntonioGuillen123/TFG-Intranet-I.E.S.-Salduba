<?php

namespace App\Controller;

use App\Service\SessionService;
use App\Entity\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SessionController extends AbstractController
{
    public function index(Request $request): Response
    {
        $route = $request->get('redirect');
        $redirect = $route === '1';

        return $this->render('session/index.html.twig', [
            'redirect' => $redirect
        ]);
    }

    public function checkUser(Request $request, SessionService $session, EntityManagerInterface $entityManager): Response
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $query = $entityManager->createQuery('SELECT s FROM App\Entity\Session s WHERE s.username = :username AND s.password = :password')
            ->setParameters([
                'username' => $username,
                'password' => $password
            ]);

        $userResult = $query->getResult();

        $loged = count($userResult) == 1;

        $url = 'login';
        $params = [
            'redirect' => true
        ];

        if ($loged) {
            $session->set('username', $username);
            $session->set('role', $userResult[0]->getType());

            $url = 'index';
            $params = [];
        }

        $response = $this->redirectToRoute($url, $params);

        return $response;
    }

    public function logout(SessionService $session): Response
    {
        $session->remove('username');

        $response = $this->redirectToRoute('login');

        return $response;
    }
}
