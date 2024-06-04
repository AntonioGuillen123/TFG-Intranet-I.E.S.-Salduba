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
                'booking_date' => $queryResult[$i]->getBookingDate()->format('d-m-Y H:i'),
                'horary' => $queryResult[$i]->getHorary()->getName()
            ];
        }
        return $result;
    }

    public function getBookingsOfThisMonth($date)
    {
        $queryResult = $this->createQueryBuilder('b');
        $queryResult->where(
            $queryResult->expr()->in(
                'MONTH(b.booking_date)',
                [
                    $date - 1,
                    $date,
                    $date + 1
                ]
            )
        )
            ->orderBy('b.booking_date', 'ASC');

        return $this->convertTOJSON($queryResult);
    }

    public function getBookingsFromResourceIdAndDate($resourceID, $bookingDate, $schedule)
    {
        $content = [];
        
        foreach ($schedule as $item) { // Para cada horario que son todos los de la BD mirar si hay registro
            $horaryID = $item->getId();
            $horaryName = $item->getName();

            $queryResult = $this->createQueryBuilder('b')
                ->where('b.resource = :resource_id')
                ->andWhere('b.booking_date = :booking_date')
                ->andWhere('b.horary = :horary_id')
                ->setParameter('resource_id', intval($resourceID))
                ->setParameter('booking_date', $bookingDate) 
                ->setParameter('horary_id', intval($horaryID))
                ->orderBy('b.booking_date', 'DESC')
                ->getQuery()
                ->getResult();

            $horaryAvailable = count($queryResult) == 1;

            if (!$horaryAvailable)
                $content[] = [
                    'id' => $horaryID,
                    'name' => $horaryName
                ];
        }

        return $content;
    }
}



/* $resourceID = 1;
        $horaryID = 1;
        $bookingDate = '2024-07-19';

        $queryResult = $this->createQueryBuilder('b')
                ->where('b.resource = :resource_id')
                ->andWhere('b.booking_date = :booking_date')
                ->andWhere('b.horary = :horary_id')
                ->setParameter('resource_id', $resourceID)
                ->setParameter('booking_date', $bookingDate) 
                ->setParameter('horary_id', $horaryID)
                ->orderBy('b.booking_date', 'DESC')
                ->getQuery()
                ->getResult();

            $content = $queryResult; */