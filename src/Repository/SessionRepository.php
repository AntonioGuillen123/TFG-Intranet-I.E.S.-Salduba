<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function convertTOJSON($queryResult)
    {
        $result = [];

        for ($i = 0; $i < count($queryResult); $i++) {
            $result[] = [
                'id' => $queryResult[$i]->getId(),
                'username' => $queryResult[$i]->getUsername(),
                'password' => $queryResult[$i]->getPassword(),
                'type' => $queryResult[$i]->getType()
            ];
        }
        return $result;
    }

    public function getViewsFromNew($news)
    {
        $queryResult = $this->createQueryBuilder('s')
            ->orderBy('n.publish_date', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->convertTOJSON($queryResult);
    }
}
