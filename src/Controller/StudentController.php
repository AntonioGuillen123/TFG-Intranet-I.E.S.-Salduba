<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Student;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends AbstractController
{
    public function index(Request $request, SessionService $session, EntityManagerInterface $entityManager): Response
    {
        $username = $session->get('username');

        $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

        $userRol = $user->getType()->getName();

        $isDirective = $userRol == 'Directive';

        $students = $isDirective
            ? $entityManager->getRepository(Student::class)->findAll()
            : $entityManager->getRepository(Student::class)->findAll(); // TODO porque necesito saber donde veo a los alumnos a los que imparte clase un profesor

        return $this->render('student/index.html.twig', [
            'students' => $students,
            'isDirective' => $isDirective
        ]);
    }
}