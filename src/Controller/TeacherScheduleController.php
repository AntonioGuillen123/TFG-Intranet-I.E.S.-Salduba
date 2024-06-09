<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Teacher;
use App\Entity\TeacherSchedule;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherScheduleController extends AbstractController
{
    public function index(Request $request, SessionService $session, EntityManagerInterface $entityManager): Response
    {
        $username = $session->get('username');

        $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

        $teacher = $user->getTeacher()->getEmploye();

        $schedule = $entityManager->getRepository(TeacherSchedule::class)->findBy(['teacher_name' => $teacher]);

        return $this->render('teacher_schedule/index.html.twig', [
            'schedule' => $schedule
        ]);
    }
}
