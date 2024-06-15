<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherController extends AbstractController
{
    public function index(EntityManagerInterface $entityManager): Response
    {
        $teachers = $entityManager->getRepository(Teacher::class)->findAll();

        return $this->render('teacher/index.html.twig', [
            'teachers' => $teachers,
        ]);
    }
}