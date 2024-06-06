<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TeacherController extends AbstractController
{
    public function index(Request $request, SessionService $session, EntityManagerInterface $entityManager): Response
    {
        $teachers = $entityManager->getRepository(Teacher::class)->findAll();

        return $this->render('teacher/index.html.twig', [
            'teachers' => $teachers,
        ]);
    }
}
