<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Resource;
use App\Entity\ResourceType;
use App\Entity\Schedule;
use App\Entity\Session;
use App\Repository\BookingRepository;
use App\Service\SessionService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{
    public function index(BookingRepository $bookingRepository): Response
    {
        $date = (new \DateTime())->format('n');

        $bookings = [];

        try {
            $bookings = $bookingRepository->getBookingsOfThisMonth($date);
        } catch (Exception $e) {
            error_log('Se ha producido un error :(' . $e);
        }

        return $this->render('booking/index.html.twig', [
            'bookings' => $bookings,
        ]);
    }

    public function renderBookings(int $id, Request $request, BookingRepository $bookingRepository)
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        $date = intval((new \DateTime())->format('n')) + $id;

        $bookings = [];

        if ($isAYAX) {
            try {
                $bookings = $bookingRepository->getBookingsOfThisMonth($date);

                $response = new JsonResponse([
                    'content' => $bookings,
                    'month' => $id
                ]);
            } catch (Exception $e) {
                error_log('Se ha producido un error :(' . $e);
            }
        }

        return $response;
    }

    private function convertTOJSON($data)
    {
        $content = [];

        foreach ($data as $resourceType) {
            $content[] = [
                'id' => $resourceType->getId(),
                'name' => $resourceType->getName()
            ];
        }
        return $content;
    }

    public function getResourceTypes(Request $request, EntityManagerInterface $entityManager)
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            try {
                $resourceTypes = $entityManager->getRepository(ResourceType::class)->findAll();

                $content = $this->convertTOJSON($resourceTypes);

                $response = new JsonResponse(['resourceTypes' => $content]);
            } catch (Exception $e) {
                $response = new Response($status = Response::HTTP_NO_CONTENT);
            }
        }

        return $response;
    }

    public function getResourceFromType(int $id, Request $request, EntityManagerInterface $entityManager)
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            try {
                $resources = $entityManager->getRepository(Resource::class)->findBy(['resource_type' => $id]);

                $content = $this->convertTOJSON($resources);

                $response = new JsonResponse(['resources' => $content]);
            } catch (Exception $e) {
                $response = new Response($status = Response::HTTP_NO_CONTENT);
            }
        }

        return $response;
    }

    public function getScheduleFromResource(Request $request, BookingRepository $bookingRepository, EntityManagerInterface $entityManager)
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        $resourceID = intval($request->request->get('resourceID'));
        $date = $request->request->get('date');
        
        if ($isAYAX) {
            try {
                $schedule = $entityManager->getRepository(Schedule::class)->findAll();

                $content = $bookingRepository->getBookingsFromResourceIdAndDate($resourceID, $date, $schedule);

                $response = new JsonResponse(['schedule' => $content]);
            } catch (Exception $e) {
                $response = new Response($e);
            }
        }

        return $response;
    }

    public function makeBooking(Request $request, SessionService $session, BookingRepository $bookingRepository, EntityManagerInterface $entityManager)
    {
        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        $username = $session->get('username');

        $resourceID = intval($request->request->get('resourceID'));
        $bookingDate = intval($request->request->get('bookingDateID'));
        $dateParam = $request->request->get('date');
        $date = \DateTime::createFromFormat('Y-m-d', $dateParam);
        $date->setTime(0, 0);
        
        if ($isAYAX) {
            try {
                $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);
                $resource = $entityManager->getRepository(Resource::class)->find($resourceID);
                $schedule = $entityManager->getRepository(Schedule::class)->find($bookingDate);

                $booking = new Booking();
                $booking->setUserFrom($user);
                $booking->setResource($resource);
                $booking->setHorary($schedule);
                $booking->setBookingDate($date);

                $entityManager->persist($booking);

                $entityManager->flush();

                $response = new Response($status = Response::HTTP_ACCEPTED);
            } catch (Exception $e) {
                $response = new Response($e);
            }
        }

        return $response;
    }
}