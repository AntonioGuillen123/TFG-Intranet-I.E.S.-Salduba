<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{
    public function index(BookingRepository $bookingRepository): Response
    {
        $bookings = $bookingRepository->getBookingsOfThisMonth();

        return $this->render('booking/index.html.twig', [
            'bookings' => $bookings,
        ]);
    }
}
