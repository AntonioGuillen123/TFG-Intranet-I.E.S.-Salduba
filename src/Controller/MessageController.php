<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class MessageController extends AbstractController
{
    public function index(Request $request, SessionService $session, MessageRepository $messageRepository)
    {
        $username = $session->get('username');

        $mode = $request->get('mode');

        $messages = $messageRepository->findAllMessagesFromUser($username);

        return $this->render('message/index.html.twig', [
            'username' => $username,
            'messagesRaw' => $messages
        ]);
    }

    public function delete(int $id, Request $request, SessionService $session, EntityManagerInterface $entityManager)
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            try {
                $message = $entityManager->getRepository(Message::class)->find($id);

                $entityManager->remove($message);
                $entityManager->flush();

                $response = new Response($status = Response::HTTP_ACCEPTED);
            } catch (Exception $e) {
                $response = new Response($status = Response::HTTP_NO_CONTENT);
            }
        } else {
            $response = $this->redirectToRoute('index');
        }

        return $response;
    }
}
