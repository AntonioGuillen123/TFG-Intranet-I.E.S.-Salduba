<?php

namespace App\Controller;

use App\Entity\Absence;
use App\Entity\Session;
use App\Entity\TeacherSchedule;
use App\Form\AbsenceType;
use App\Repository\AbsenceRepository;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbsenceController extends AbstractController
{
    private function getAbsences(string $username, EntityManagerInterface $entityManager, AbsenceRepository $absenceRepository)
    {
        try {
            $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

            $userRol = $user->getType()->getName();

            $isDirective = $userRol == 'Directive';

            $teacher = $user->getTeacher();

            $teacherID = $teacher->getId();

            $teacherName = $teacher->getEmploye();

            $schedule = $entityManager->getRepository(TeacherSchedule::class)->findBy([
                'teacher_name' => $teacherName,
                'subject_abbreviation' => 'GUA'
            ]);

            $absences = [];

            foreach ($schedule as $item) {
                $hour = $item->getHourNumber();
                $day = $item->getDayNumber();

                $absences = array_merge($absences, $absenceRepository->getAbsences($teacherID, $hour, $day));
            }
        } catch (Exception $e) {
            $absences = [];
            $isDirective = false;
        }

        return [$absences, $isDirective];
    }

    public function index(Request $request, SessionService $session, EntityManagerInterface $entityManager, AbsenceRepository $absenceRepository): Response
    {
        $username = $session->get('username');

        [$absences, $isDirective] = $this->getAbsences($username, $entityManager, $absenceRepository);

        return $this->render('absence/index.html.twig', [
            'absences' => $absences,
            'isDirective' => $isDirective
        ]);
    }

    public function coverAbsence(int $id, Request $request, SessionService $session, EntityManagerInterface $entityManager, AbsenceRepository $absenceRepository)
    {
        $username = $session->get('username');

        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            try {
                $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

                $teacher = $user->getTeacher();

                $absence = $entityManager->getRepository(Absence::class)->find($id);

                $absence->setCoveredBy($teacher);

                $entityManager->persist($absence);

                $entityManager->flush();

                [$absences, $isDirective] = $this->getAbsences($username, $entityManager, $absenceRepository);

                $content = $this->renderView('absence/partials/absence.html.twig', [
                    'absences' => $absences,
                    'isDirective' => $isDirective
                ]);

                $response = new JsonResponse([
                    'content' => $content
                ]);
            } catch (Exception $e) {
                $response = new Response($status = Response::HTTP_NO_CONTENT);
            }
        }

        return $response;
    }

    public function createView()
    {
        $form = $this->createForm(AbsenceType::class);

        return $this->render('absence/create.html.twig', [
            'form' => $form
        ]);
    }

    public function create(Request $request, SessionService $session, EntityManagerInterface $entityManager)
    {
        $username = $session->get('username');

        $newAbsence = new Absence();

        $form = $this->createForm(AbsenceType::class, $newAbsence);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

                $teacher = $user->getTeacher();

                $newAbsence = $form->getData();

                $newAbsence->setAuthor($teacher);

                $entityManager->persist($newAbsence);

                $entityManager->flush();
            } catch (Exception $e) {
            }   
        }

        return $this->redirectToRoute('getAbsences');
    }
}
