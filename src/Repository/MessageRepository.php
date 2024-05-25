<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Message>
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function findAllMessagesFromUser($username)
    {
        $queryResult = $this->createQueryBuilder('m')
            ->where('m.user_to IN (SELECT s.id FROM App\Entity\Session s WHERE s.username = :username)')
            ->setParameter('username', $username)
            ->getQuery()
            ->getResult();

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

        return $result;
    }
}
