<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Repository\NotificationRepository;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NotificationController extends AbstractController
{
    public function index(Request $request, SessionService $session, NotificationRepository $notificationRepository): Response
    {
        $username = $session->get('username');

        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            $notifications = $notificationRepository->findAllNotificationsFromUserToJSON($username);

            $response = $this->json(json_encode($notifications));
        }

        return $response;
    }

    public function delete(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            try {
                $message = $entityManager->getRepository(Notification::class)->find($id);

                $entityManager->remove($message);
                $entityManager->flush();

                $response = new Response($status = Response::HTTP_ACCEPTED);
            } catch (Exception $e) {
                $response = new Response($status = Response::HTTP_NO_CONTENT);
            }
        }

        return $response;
    }

    public function deleteAll(Request $request, SessionService $session, EntityManagerInterface $entityManager, NotificationRepository $notificationRepository): Response
    {
        $username = $session->get('username');

        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            $notifications = $notificationRepository->findAllNotificationsFromUser($username);

            foreach ($notifications as $notification) $entityManager->remove($notification);

            $entityManager->flush();

            $response = new Response('Notifications deleted', Response::HTTP_NO_CONTENT);
        }

        return $response;
    }
}