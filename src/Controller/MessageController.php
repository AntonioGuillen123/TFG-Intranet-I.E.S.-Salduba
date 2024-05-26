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
    public function index(Request $request, SessionService $session, MessageRepository $messageRepository): Response
    {
        $username = $session->get('username');

        $mode = $request->get('mode');

        try {

            switch ($mode) {
                case 'inbox':
                    $mode = 'Recibidos';
                    $messages = $messageRepository->findAllMessagesFromUser($username);

                    break;
                case 'important':
                    $mode = 'Destacados';
                    $messages = $messageRepository->findImportantMessagesFromUser($username);

                    break;
                case 'send':
                    $mode = 'Enviados';
                    $messages = $messageRepository->findSendMessagesFromUser($username);

                    break;
                case 'removed':
                    $mode = 'Eliminados';
                    $messages = $messageRepository->findRemovedMessagesFromUser($username);

                    break;
                default:
                    $mode = 'Todos';
                    $messages = array_merge(
                        $messageRepository->findAllMessagesFromUser($username),
                        $messageRepository->findSendMessagesFromUser($username)
                    );

                    break;
            }
        } catch (Exception $e) {
            $messages = [];
        }

        return $this->render('message/index.html.twig', [
            'username' => $username,
            'mode' => $mode,
            'messagesRaw' => $messages
        ]);
    }

    public function delete(int $id, Request $request, SessionService $session, EntityManagerInterface $entityManager): Response
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            try { //TODO REUTILIZAR ESTO
                $message = $entityManager->getRepository(Message::class)->find($id);

                if ($message->isRemoved()) {
                    $entityManager->remove($message);
                } else {
                    $message->setRemoved(true);

                    $entityManager->persist($message);
                }

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

    public function getAllMessagesCount(Request $request, SessionService $session, MessageRepository $messageRepository): Response
    {
        $username = $session->get('username');

        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            try {
                $allMessages = $messageRepository->findAllMessagesFromUser($username);
                $sendMessages = $messageRepository->findSendMessagesFromUser($username);
                $importantMessages = $messageRepository->findImportantMessagesFromUser($username);
                $removedMessages = $messageRepository->findRemovedMessagesFromUser($username);

                $messages = [
                    'all' => count($allMessages),
                    'removed' => count($removedMessages),
                    'important' => count($importantMessages),
                    'send' => count($sendMessages)
                ];

                $response = $this->json(json_encode($messages));
            } catch (Exception $e) {
                $response = new Response($status = Response::HTTP_NO_CONTENT);
            }
        } else {
            $response = $this->redirectToRoute('index');
        }

        return $response;
    }

    public function deleteSelectedMessages(Request $request, EntityManagerInterface $entityManager)
    {
        $messages = $request->toArray();

         foreach ($messages as $message) {
            $findMessage = $entityManager->getRepository(Message::class)->find($message['id']);

            if ($findMessage) {
                if ($findMessage->isRemoved()) {
                    $entityManager->remove($findMessage);
                } else {
                    $findMessage->setRemoved(true);

                    $entityManager->persist($findMessage);
                }
            }
        }

        $entityManager->flush();

        return new Response($status = Response::HTTP_ACCEPTED);
    }
}
