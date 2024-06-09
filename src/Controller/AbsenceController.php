<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Entity\Session;
use App\Entity\TeacherSchedule;
use App\Repository\AbsenceRepository;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbsenceController extends AbstractController
{
    public function index(Request $request, SessionService $session, EntityManagerInterface $entityManager, AbsenceRepository $absenceRepository): Response
    {
        $username = $session->get('username');

        $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

        $teacherID = $user->getTeacher();
        $teacherName = $user->getTeacher()->getEmploye();

        // $absences = $entityManager->getRepository(Absence::class)->findBy();

        $schedule = $entityManager->getRepository(TeacherSchedule::class)->findBy([
            'teacher_name' => $teacherName,
            'subject_abbreviation' => 'GUA'
        ]);

        $absences = [];

        foreach ($schedule as $item) {
            $hour = $item->getHourNumber();
            $day = $item->getDayNumber();

            $absences = array_merge($absences, $absenceRepository->getAbsences($hour, $day));
        }

        return $this->render('absence/index.html.twig', [
            'absences' => $absences
        ]);
    }
}
