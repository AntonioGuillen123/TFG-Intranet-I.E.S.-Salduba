<?php

namespace App\Repository;

use App\Entity\DisciplinePart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DisciplinePart>
 */
class DisciplinePartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DisciplinePart::class);
    }

   /*  public function convertTOJSON($queryResult)
    {
        $result = [];

        for ($i = 0; $i < count($queryResult); $i++) {
            $result[] = [
                'id' => $queryResult[$i]->getId(),
                'user_from' => $queryResult[$i]->getUserFrom()->getUsername(),
                'resource_name' => $queryResult[$i]->getResource()->getName(),
                'resource_type' => $queryResult[$i]->getResource()->getResourceType()->getName(),
                'booking_date' => $queryResult[$i]->getBookingDate()->format('d-m-Y H:i'),
                'horary' => $queryResult[$i]->getHorary()->getName()
            ];
        }
        return $result;
    }

    public function getParts()
    {
        $queryResult = $this->createQueryBuilder('dp')
            ->getQuery()
            ->getResult();
    } */
}
