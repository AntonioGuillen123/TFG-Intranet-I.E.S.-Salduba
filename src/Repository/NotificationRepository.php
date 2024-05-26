<?php

namespace App\Repository;

use App\Entity\Notification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Notification>
 */
class NotificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    public function convertTOJSON($queryResult)
    {
        $result = [];

        for ($i = 0; $i < count($queryResult); $i++) {
            $result[] = [
                'id' => $queryResult[$i]->getId(),
                'title' => $queryResult[$i]->getTitle(),
                'user_from' => $queryResult[$i]->getUserFrom()->getUsername(),
                'user_to' => $queryResult[$i]->getUserTo()->getUsername(),
                'type' => $queryResult[$i]->getType()->getName(),
                'associated_id' => $queryResult[$i]->getAssociatedId()
            ];
        }

        return $result;
    }

    public function findAllNotificationsFromUser($username)
    {

        $queryResult = $this->createQueryBuilder('n')
            ->where('n.user_to IN (SELECT s.id FROM App\Entity\Session s WHERE s.username = :username)')
            ->setParameter('username', $username)
            ->getQuery()
            ->getResult();

        return $this->convertTOJSON($queryResult);
    }
}
