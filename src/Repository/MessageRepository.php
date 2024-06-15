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

    public function convertTOJSON($queryResult)
    {
        $result = [];

        for ($i = 0; $i < count($queryResult); $i++) {
            $result[] = [
                'id' => $queryResult[$i]->getId(),
                'affair' => $queryResult[$i]->getAffair(),
                'content' => $queryResult[$i]->getContent(),
                'send_date' => $queryResult[$i]->getSendDate()->format('d-m-Y H:i'),
                'removed' => $queryResult[$i]->isRemoved(),
                'important' => $queryResult[$i]->isImportant(),
                'readed' => $queryResult[$i]->isReaded(),
                'user_from' => $queryResult[$i]->getUserFrom()->getUsername(),
                'user_to' => $queryResult[$i]->getUserTo()->getUsername(),
                'teacher_to' =>$queryResult[$i]->getUserTo()->getTeacher()->getEmploye(),
                'teacher_from' =>$queryResult[$i]->getUserFrom()->getTeacher()->getEmploye(),
                'image' => $queryResult[$i]->getUserTo()->getTeacher()->getImage()
            ];
        }
        return $result;
    }

    public function findAllMessagesFromUser($username)
    {
        $queryResult = $this->createQueryBuilder('m')
            ->where('m.user_to IN (SELECT s.id FROM App\Entity\Session s WHERE s.username = :username)')
            ->andWhere('m.removed = false')
            ->setParameter('username', $username)
            ->orderBy('m.send_date', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->convertTOJSON($queryResult);
    }

    public function findSendMessagesFromUser($username)
    {
        $queryResult = $this->createQueryBuilder('m')
            ->where('m.user_from IN (SELECT s.id FROM App\Entity\Session s WHERE s.username = :username)')
            ->andWhere('m.removed = false')
            ->setParameter('username', $username)
            ->orderBy('m.send_date', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->convertTOJSON($queryResult);
    }

    public function findImportantMessagesFromUser($username)
    {
        $queryResult = $this->createQueryBuilder('m')
            ->where('m.user_to IN (SELECT s.id FROM App\Entity\Session s WHERE s.username = :username)')
            ->andWhere('m.important = true')
            ->andWhere('m.removed = false')
            ->setParameter('username', $username)
            ->orderBy('m.send_date', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->convertTOJSON($queryResult);
    }

    public function findImportantSendMessagesFromUser($username)
    {
        $queryResult = $this->createQueryBuilder('m')
            ->where('m.user_from IN (SELECT s.id FROM App\Entity\Session s WHERE s.username = :username)')
            ->andWhere('m.important = true')
            ->andWhere('m.removed = false')
            ->setParameter('username', $username)
            ->orderBy('m.send_date', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->convertTOJSON($queryResult);
    }

    public function findRemovedMessagesFromUser($username)
    {
        $queryResultTo = $this->createQueryBuilder('m')
            ->where('m.user_to IN (SELECT s.id FROM App\Entity\Session s WHERE s.username = :username) 
                ')
            ->andWhere('m.removed = true')
            ->setParameter('username', $username)
            ->orderBy('m.send_date', 'DESC')
            ->getQuery()
            ->getResult();

        $queryResultFrom = $this->createQueryBuilder('m')
            ->where('m.user_from IN (SELECT s.id FROM App\Entity\Session s WHERE s.username = :username)')
            ->andWhere('m.removed = true')
            ->setParameter('username', $username)
            ->orderBy('m.send_date', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->convertTOJSON(array_merge($queryResultTo, $queryResultFrom));
    }
}
