<?php

namespace App\Repository;

use App\Entity\TeacherSchedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TeacherSchedule>
 */
class TeacherScheduleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeacherSchedule::class);
    }
    
   /*  public function convertTOJSON($queryResult)
    {
        $result = [];

        for ($i = 0; $i < count($queryResult); $i++) {
            $result[] = [
                'id' => $queryResult[$i]->getId(),
                'day' => $queryResult[$i]->getDayNumber()->getName(),
                'hour' => $queryResult[$i]->getHourNumber()->getName(),
                'abbreviation' => $queryResult[$i]->getSubjectAbbreviation(),
                'removed' => $queryResult[$i]->isRemoved(),
                'important' => $queryResult[$i]->isImportant(),
                'readed' => $queryResult[$i]->isReaded(),
                'user_from' => $queryResult[$i]->getUserFrom()->getUsername(),
                'user_to' => $queryResult[$i]->getUserTo()->getUsername(),
                'image' => $queryResult[$i]->getUserTo()->getTeacher()->getImage()
            ];
        }
        return $result;
    } */

    public function getSchedule(){

    }
}
