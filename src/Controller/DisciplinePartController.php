<?php

namespace App\Controller;

use App\Entity\CrimeMeasure;
use App\Entity\DisciplinePart;
use App\Entity\Session;
use App\Entity\Student;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DisciplinePartController extends AbstractController
{
    public function index(Request $request, SessionService $session, EntityManagerInterface $entityManager): Response
    {
        try {
            $username = $session->get('username');

            $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

            $userRol = $user->getType()->getName();

            $isDirective = $userRol == 'Directive';

            $parts = $entityManager->getRepository(DisciplinePart::class)->findAll();

            $measures = $entityManager->getRepository(CrimeMeasure::class)->findAll();
        } catch (Exception $e) {
        }

        return $this->render('discipline_part/index.html.twig', [
            'parts' => $parts,
            'measures' => $measures,
            'isDirective' => $isDirective
        ]);
    }

    public function makeMeasure(Request $request, SessionService $session, EntityManagerInterface $entityManager): Response
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            try {
                $username = $session->get('username');

                $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);
    
                $userRol = $user->getType()->getName();
    
                $isDirective = $userRol == 'Directive';

                $partID = intval($request->request->get('partID'));
                $measureID = intval($request->request->get('measureID'));

                $parts = $entityManager->getRepository(DisciplinePart::class)->findAll();
                $measures = $entityManager->getRepository(CrimeMeasure::class)->findAll();

                $part = $entityManager->getRepository(DisciplinePart::class)->find($partID);
                $measure = $entityManager->getRepository(CrimeMeasure::class)->find($measureID);

                $part->setMeasure($measure);

                $entityManager->persist($part);

                $entityManager->flush();

                $content = $this->renderView('discipline_part/partials/discipline_part.html.twig', [
                    'parts' => $parts,
                    'measures' => $measures,
                    'isDirective' => $isDirective
                ]);

                $response = new JsonResponse(['content' => $content]);
            } catch (Exception $e) {
            }
        }

        return $response;
    }
}
