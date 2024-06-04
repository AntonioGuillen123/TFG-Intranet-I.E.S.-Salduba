<?php

namespace App\Controller;

use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends AbstractController
{
    public function index(Request $request, SessionService $session, EntityManagerInterface $entityManager): Response
    {
        $find = $entityManager->getRepository(Student::class)->findBy();
        
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
}