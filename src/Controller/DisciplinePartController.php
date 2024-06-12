<?php

namespace App\Controller;

use App\Entity\CrimeMeasure;
use App\Entity\DisciplinePart;
use App\Entity\Session;
use App\Entity\Student;
use App\Form\DisciplinePartType;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

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

    public function createDisciplinePartView(Request $request, SessionService $session, EntityManagerInterface $entityManager)
    {
        $username = $session->get('username');

        $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

        $userRol = $user->getType()->getName();

        $isDirective = $userRol == 'Directive';

        $form = $this->createForm(DisciplinePartType::class);

        return $this->render('discipline_part/create.html.twig', [
            'form' => $form,
            'isDirective' => $isDirective
        ]);
    }

    public function createDisciplinePart(Request $request, SessionService $session, EntityManagerInterface $entityManager, KernelInterface $kernel)
    {
        $username = $session->get('username');

        $newDisciplinePart = new DisciplinePart();

        $form = $this->createForm(DisciplinePartType::class, $newDisciplinePart);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

                $teacher = $user->getTeacher();

                $newDisciplinePart = $form->getData();

                $newDisciplinePart->setTeacher($teacher);

                $entityManager->persist($newDisciplinePart);

                $entityManager->flush();

                $pdf = $request->request->get('pdf');

                if($pdf) $this->generatePDF($kernel, $newDisciplinePart);
            } catch (Exception $e) {
            }   
        }

        return $this->redirectToRoute('getDisciplineParts');
    }

    public function makeMeasure(Request $request, SessionService $session, EntityManagerInterface $entityManager, KernelInterface $kernel): Response
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
                $pdf = $request->request->get('pdf');

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

                if ($pdf == '1') $this->generatePDF($kernel, $part);

                $response = new JsonResponse(['content' => $content, 'pdf' => $pdf]);
            } catch (Exception $e) {
            }
        }

        return $response;
    }

    public function generatePDF($kernel, $part)
    {
        $student = $part->getStudent();
        $studentName = $student->getName();
        $studentUnit = $student->getUnit();

        $firstTutorEmail = $student->getFirstTutorEmail();
        $secondTutorEmail = $student->getSecondTutorEmail();
        $firstTutorName = $student->getFirstTutorName() . $student->getFirstTutorFirstSurname() . $student->getFirstTutorSecondSurname();
        $secondTutorName = $student->getSecondTutorName() . $student->getSecondTutorSecondSurname() . $student->getSecondTutorSecondSurname();

        $firstTutor = [
            'name' => $firstTutorName,
            'email' => $firstTutorEmail
        ];

        $secondTutor = [
            'name' => $secondTutorName,
            'email' => $secondTutorEmail
        ];

        $crime = $part->getCrime();
        $crimeName = $crime->getName();
        $crimeSeverity = $crime->getSeverity()->getName();

        $measure = $part->getMeasure()->getName();

        $teacher = $part->getTeacher()->getEmploye();

        $date = $part->getPartDate()->format('d/m/Y');

        $htmlContent = '<!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>PDF Report</title>
                </head>

                <body>
                    <div>
                        <img src="https://i0.wp.com/blogsaverroes.juntadeandalucia.es/educacionenvaloresdelegacionmalaga/files/2021/05/descarga.jpg?w=225&ssl=1" alt="Imagen Salduba">
                        <h1>I.E.S Salduba</h1>
                    </div>
                    <div>
                        <div>
                            <label><b>Alumn@:</b> </label>
                            <span>%s</span>
                        </div>
                        <div>
                            <label><b>Curso:</b> </label>
                            <span>%s</span>
                        </div>
                        <div>
                            <label><b>Fecha de la falta: </b></label>
                            <span>%s</span>
                        </div>
                        <div>
                            <label><b>Falta de disciplina:</b> </label>
                            <span>%s</span>
                        </div>
                        <div>
                            <label><b>Motivo:</b> </label>
                            <span>%s</span>
                        </div>
                        <div>
                            <label><b>Sanción:</b> </label>
                            <span>%s</span>
                        </div>
                        <div>
                            <label><b>Profesor:</b> </label>
                            <span>%s</span>
                        </div>
                    </div>
                </body>

                </html>';

        $pdfContent = sprintf($htmlContent, $studentName, $studentUnit, $date, $crimeSeverity, $crimeName, $measure, $teacher);

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($pdfContent);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $output = $dompdf->output();

        $this->generateEmail($kernel, $output, $firstTutor, $secondTutor);
    }

    public function generateEmail($kernel, $pdfContent, $firstTutor, $secondTutor)
    {
        $dotenv = new Dotenv();
        $dotenv->loadEnv($kernel->getProjectDir() . '/.env');

        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];  // Cambia esto por tu servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USER'];  // Tu correo electrónico
            $mail->Password = $_ENV['SMTP_PASSWORD'];  // Tu contraseña
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;  // Puerto SMTP

            // Configuración del remitente
            $mail->setFrom($_ENV['SMTP_USER'], 'Antonio Guillén');
            $mail->addAddress('antonioguillengarcia123@gmail.com', 'Antonio Guillén García :))');
            //$mail->addAddress('benitezjuanma25@gmail.com', 'Yuanma');
            // if ($firstTutor['email']) $mail->addAddress($firstTutor['email'], $firstTutor['name']);
            // if ($secondTutor['email']) $mail->addAddress($secondTutor['email'], $secondTutor['name']);

            // Asunto y cuerpo del mensaje
            $mail->Subject = 'Nuevo Parte De Disciplina';
            $mail->Body    = 'Desde el I.E.S Salduba informamos que su hij@ tiene un nuevo parte. Se le adjunta un pdf con los detalles de este. Un Saludo';

            // Adjuntar el archivo PDF desde la memoria
            $mail->addStringAttachment($pdfContent, 'Parte.pdf');

            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);

            // Enviar el correo
            $mail->send();
            error_log('El mensaje ha sido enviado');
        } catch (Exception $e) {
            error_log("El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}");
        }
    }
}
