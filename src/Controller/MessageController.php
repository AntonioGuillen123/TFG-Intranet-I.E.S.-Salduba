<?php

namespace App\Controller;

use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class MessageController extends AbstractController
{
    public function index(Request $request, SessionService $session, EntityManagerInterface $entityManager)
    {
        $username = $session->get('username');

        $mode = $request->get('mode');

        $query = $entityManager->createQuery(
            'SELECT m FROM App\Entity\Message m WHERE m.user_to IN 
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
                'affair' => $queryResult[$i]->getAffair(),
                'content' => $queryResult[$i]->getContent(),
                'send_date' => $queryResult[$i]->getSendDate()->format('d-m-Y'),
                'removed' => $queryResult[$i]->isRemoved(),
                'important' => $queryResult[$i]->isImportant(),
                'user_from' => $queryResult[$i]->getUserFrom()->getUsername(),
                'user_to' => $queryResult[$i]->getUserTo()->getUsername(),
            ];
        }

        return $this->render('message/index.html.twig', [
            'username' => $username,
            'messagesRaw' => $result
        ]);
    }
}
