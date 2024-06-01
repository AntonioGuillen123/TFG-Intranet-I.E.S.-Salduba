<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Session;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Service\SessionService;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class MessageController extends AbstractController
{
    public function index(Request $request, SessionService $session, MessageRepository $messageRepository): Response
    {
        $username = $session->get('username');

        $mode = $request->get('mode');

        [$messages, $mode] = $this->getMessages($messageRepository, $username, $mode);

        return $this->render('message/index.html.twig', [
            'username' => $username,
            'mode' => $mode,
            'messages' => $messages
        ]);
    }

    public function getMessages($messageRepository, $username,  $mode)
    {
        try {
            switch ($mode) {
                case 'inbox':
                    $mode = 'Recibidos';
                    $messages = $messageRepository->findAllMessagesFromUser($username);

                    break;
                case 'important':
                    $mode = 'Destacados';
                    $messages = array_merge(
                        $messageRepository->findImportantMessagesFromUser($username),
                        $messageRepository->findImportantSendMessagesFromUser($username)
                    );

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

        return [$messages, $mode];
    }

    public function renderMessages(Request $request, SessionService $session, MessageRepository $messageRepository)
    {
        $username = $session->get('username');

        $mode = $request->get('mode');

        $input = strtolower($request->request->get('input'));

        [$messages, $mode] = $this->getMessages($messageRepository, $username, $mode);

        $searchMessages = [];

        foreach ($messages as $message) {
            $searchUser = $username == $message['user_from'] ? 'user_to' : 'user_from';

            $messageAffair = $message['affair'];
            $messageContent = $message['content'];
            $messageAuthor = $message[$searchUser];

            if (
                str_contains(strtolower($messageAffair), $input)
                || str_contains(strtolower($messageContent), $input)
                || str_contains(strtolower($messageAuthor), $input)
            )
                $searchMessages[] = $message;
        }

        $content = $this->renderView('message/partials/message.html.twig', [
            'username' => $username,
            'mode' => $mode,
            'messages' => $searchMessages
        ]);

        return new JsonResponse(['content' => $content]);
    }

    public function createView(Request $request, SessionService $session, EntityManagerInterface $entityManager)
    {
        $username = $session->get('username');

        $form = $this->createForm(MessageType::class, null, [
            'username' => $username,
            'entity' => $entityManager
        ]);

        return $this->render('message/create.html.twig', [
            'form' => $form
        ]);
    }

    public function create(Request $request, SessionService $session, EntityManagerInterface $entityManager)
    {
        $username = $session->get('username');

        $newMessage = new Message();

        $form = $this->createForm(MessageType::class, $newMessage, [
            'username' => $username,
            'entity' => $entityManager
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $userFrom = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);
                $date = new \DateTime('Europe/Madrid');
                $date->setTimezone(new DateTimeZone('Europe/Madrid'));

                $newMessage->setUserFrom($userFrom);
                $newMessage->setSendDate($date);
                $newMessage->setRemoved(false);
                $newMessage->setReaded(false);
                $newMessage->setImportant(false);

                $entityManager->persist($newMessage);

                $entityManager->flush();
            } catch (Exception $e) {
                error_log('Error' . $e);
            }
        }

        return $this->redirectToRoute('getMessages', [
            'mode' => 'send',
            'newMessage' => $newMessage->getId()
        ]);
    }

    public function delete(int $id, Request $request, EntityManagerInterface $entityManager): Response
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
                $importantSendMessages = $messageRepository->findImportantSendMessagesFromUser($username);
                $removedMessages = $messageRepository->findRemovedMessagesFromUser($username);

                $messages = [
                    'all' => count($allMessages),
                    'removed' => count($removedMessages),
                    'important' => count($importantMessages) + count($importantSendMessages),
                    'send' => count($sendMessages)
                ];

                $response = $this->json(json_encode($messages));
            } catch (Exception $e) {
                $response = new Response($status = Response::HTTP_NO_CONTENT);
            }
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

    public function markImportant(int $id, Request $request, EntityManagerInterface $entityManager)
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            try {
                $message = $entityManager->getRepository(Message::class)->find($id);

                $messageValue = $message->isImportant();

                $message->setImportant(!$messageValue);

                $entityManager->persist($message);

                $entityManager->flush();

                $response = $this->json([
                    'isImportant' => !$messageValue
                ]);
            } catch (Exception $e) {
                $response = new Response($status = Response::HTTP_NO_CONTENT);
            }
        }

        return $response;
    }

    public function markReaded(int $id, Request $request, SessionService $session, EntityManagerInterface $entityManager)
    {
        $username = $session->get('username');

        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            try {
                $message = $entityManager->getRepository(Message::class)->find($id);

                $userTo = $message->getUserTo()->getUsername();

                if ($userTo === $username) $message->setReaded(true);

                $entityManager->persist($message);

                $entityManager->flush();

                $response = new Response($status = Response::HTTP_ACCEPTED);
            } catch (Exception $e) {
                $response = new Response($status = Response::HTTP_NO_CONTENT);
            }
        }

        return $response;
    }
}
