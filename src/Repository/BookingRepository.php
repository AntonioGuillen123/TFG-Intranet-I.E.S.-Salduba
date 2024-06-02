<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DoctrineExtensions\Query\Mysql\Month;

/**
 * @extends ServiceEntityRepository<Booking>
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    public function convertTOJSON($resultt)
    {
        $result = [];

        $queryResult = $resultt->getQuery()->getResult();

        for ($i = 0; $i < count($queryResult); $i++) {
            $result[] = [
                'id' => $queryResult[$i]->getId(),
                'user_from' => $queryResult[$i]->getUserFrom()->getUsername(),
                'resource_name' => $queryResult[$i]->getResource()->getName(),
                'resource_type' => $queryResult[$i]->getResource()->getResourceType()->getName(),
                'booking_date' => $queryResult[$i]->getBookingDate()->format('d-m-Y H:i')
            ];
        }
        return $result;
    }

    public function getBookingsOfThisMonth()
    {
        $queryResult = $this->createQueryBuilder('b');
        $queryResult->where(
            $queryResult->expr()->in(
                'MONTH(b.booking_date)',
                [
                    (new \DateTime())->format('n') - 1,
                    (new \DateTime())->format('n'),
                    (new \DateTime())->format('n') + 1
                ]
            )
        )
        ->orderBy('b.booking_date', 'ASC');
        
        return $this->convertTOJSON($queryResult);
    }
}
