<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<News>
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, News::class);
    }

    public function convertTOJSON($queryResult, $userId)
    {
        $result = [];

        for ($i = 0; $i < count($queryResult); $i++) {
            $views = $queryResult[$i]->getViews();
            $viewCount = count($views);
            $isView = false;

            for ($j = 0; !$isView && $j < $viewCount; $j++) {
                $view = $views[$j];

                $viewUser = $view->getId();

                if ($viewUser == $userId) $isView = true;
            }

            $result[] = [
                'id' => $queryResult[$i]->getId(),
                'title' => $queryResult[$i]->getTitle(),
                'content' => $queryResult[$i]->getContent(),
                'publish_date' => $queryResult[$i]->getPublishDate()->format('d-m-Y'),
                'image' => $queryResult[$i]->getImage(),
                'views' => $viewCount,
                'isView' => $isView,
                'user_from' => $queryResult[$i]->getUserFrom()->getUsername()
            ];
        }
        return $result;
    }

    public function findAllNews($userId)
    {
        $queryResult = $this->createQueryBuilder('n')
            ->orderBy('n.publish_date', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->convertTOJSON($queryResult, $userId);
    }

    public function findSearchNews($input, $userId)
    {
        $queryResult = $this->createQueryBuilder('n')
            ->where('LOWER(n.title) LIKE :input')
            ->orWhere('LOWER(n.content) LIKE :input')
            ->setParameter('input', '%' . strtolower($input) . '%')
            ->orderBy('n.publish_date', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->convertTOJSON($queryResult, $userId);
    }
}
