<?php

namespace App\Repository;

use App\Entity\Absence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Absence>
 */
class AbsenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Absence::class);
    }

    public function convertTOJSON($queryResult)
    {
        $months = [
            'January' => 'Enero',
            'February' => 'Febrero',
            'March' => 'Marzo',
            'April' => 'Abril',
            'May' => 'Mayo',
            'June' => 'Junio',
            'July' => 'Julio',
            'August' => 'Agosto',
            'September' => 'Septiembre',
            'October' => 'Octubre',
            'November' => 'Noviembre',
            'December' => 'Diciembre'
        ];

        $result = [];

        for ($i = 0; $i < count($queryResult); $i++) {
            $date = $queryResult[$i]->getAbsenceDate();

            $day = $date->format('d');
            $month = $date->format('F');
            $year = $date->format('Y');

            $result[] = [
                'id' => $queryResult[$i]->getId(),
                'task' => $queryResult[$i]->getTask(),
                'reason' => $queryResult[$i]->getReason(),
                'author' => $queryResult[$i]->getAuthor()->getEmploye(),
                'absence_date' => $day . ' de ' . ($months[$month]) . ' de ' . $year,
                'hour' => $queryResult[$i]->getHour()
            ];
        }
        return $result;
    }

    public function getAbsences($hourID, $dayID)
    {
        $queryResult = $this->createQueryBuilder('a')
            ->where('DAYOFWEEK(a.absence_date) = :dayOfWeek')
            ->andWhere('a.hour = :hourId')
            ->setParameter('dayOfWeek', $dayID + 1)
            ->setParameter('hourId', $hourID)
            ->getQuery()
            ->getResult();

        return $this->convertTOJSON($queryResult);
    }
}
