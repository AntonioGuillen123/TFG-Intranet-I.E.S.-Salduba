<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NotificationController extends AbstractController
{
    public function index(Request $request, SessionService $session, EntityManagerInterface $entityManager) : Response
    {
        $username = $session->get('username');

        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            $query = $entityManager->createQuery(
                'SELECT n FROM App\Entity\Notification n WHERE n.user_to IN 
                (SELECT s.id FROM APP\Entity\Session s WHERE s.username = :username)'
            )
                ->setParameters([
                    'username' => $username
                ]);

            $queryResult = $query->getResult();

            $result = [];

            for ($i = 0; $i < count($queryResult); $i++) {
                $result[] = [
                    'id' => $queryResult[$i]->getId(),
                    'title' => $queryResult[$i]->getTitle(),
                    'user_from' => $queryResult[$i]->getUserFrom()->getUsername(),
                    'user_to' => $queryResult[$i]->getUserTo()->getUsername(),
                    'type' => $queryResult[$i]->getType()->getName()
                ];
            }

            $response = $this->json(json_encode($result));
        } else {
            $response = $this->redirectToRoute('index');
        }

        return $response;
    }
    
    public function delete(int $id, Request $request, SessionService $session, EntityManagerInterface $entityManager) : Response
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            $notification = $entityManager->getRepository(Notification::class)->find($id);

            $entityManager->remove($notification);
            $entityManager->flush();
            
            $response = new Response('Notification deleted', Response::HTTP_NO_CONTENT);

        } else {
            $response = $this->redirectToRoute('index');
        }

        return $response;
    }

    public function deleteAll(Request $request, SessionService $session, EntityManagerInterface $entityManager) : Response
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            $notifications = $entityManager->getRepository(Notification::class)->findAll();

            foreach($notifications as $notification) $entityManager->remove($notification);

            $entityManager->flush();
            
            $response = new Response('Notifications deleted', Response::HTTP_NO_CONTENT);

        } else {
            $response = $this->redirectToRoute('index');
        }

        return $response;
    }
}
