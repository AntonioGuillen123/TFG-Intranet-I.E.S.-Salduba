<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\Session;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\SessionService;
use DateTimeZone;
use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\String\Slugger\SluggerInterface;

class NewsController extends AbstractController
{
    public function index(SessionService $session, EntityManagerInterface $entityManager, NewsRepository $newsRepository): Response
    {
        $username = $session->get('username');

        $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

        $userId = $user->getId();

        $news = $newsRepository->findAllNews($userId);

        return $this->render('news/index.html.twig', [
            'username' => $username,
            'news' => $news,
        ]);
    }

    public function searchNew(Request $request, EntityManagerInterface $entityManager, SessionService $session, NewsRepository $newsRepository): Response
    {
        $username = $session->get('username');

        try {
            $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);
        } catch (Exception $e) {
            error_log('Error' . $e);
        }

        $userId = $user->getId();

        $input = $request->request->get('input');

        $news = $newsRepository->findSearchNews($input, $userId);

        $content = $this->renderView('news/partials/news.html.twig', [
            'username' => $username,
            'news' => $news,
        ]);

        return new JsonResponse(['content' => $content]);
    }

    public function createView()
    {
        $form = $this->createForm(NewsType::class);

        return $this->render('news/create.html.twig', [
            'form' => $form
        ]);
    }

    public function create(Request $request, SessionService $session, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $username = $session->get('username');

        $newNews = new News();

        $form = $this->createForm(NewsType::class, $newNews);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();

        if ($file) {
    $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    $safeFileName = $slugger->slug($originalFileName);
    $newFileName = $safeFileName . '-' . uniqid() . '-' . $file->guessExtension();

    try {
        $files_directory = 'files';

        $file->move($files_directory, $newFileName);

        $newNews->setImage($newFileName);
    } catch (FileException $e) {
        error_log('Error' . $e);
    }
}

            try {
                $userFrom = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

                $date = new \DateTime('Europe/Madrid');
                $date->setTimezone(new DateTimeZone('Europe/Madrid'));

                $newNews->setUserFrom($userFrom);
                $newNews->setPublishDate($date);

                $entityManager->persist($newNews);

                $entityManager->flush();
            } catch (Exception $e) {
                error_log('Error' . $e);
            }
        }

        return $this->redirectToRoute('getNews');
    }

    public function markViewNew(int $id, Request $request, SessionService $session, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $username = $session->get('username');

        $response = $this->redirectToRoute('index');

        $isAYAX = $request->isXmlHttpRequest();

        if ($isAYAX) {
            try {
                $user = $entityManager->getRepository(Session::class)->findOneBy(['username' => $username]);

                $new = $entityManager->getRepository(News::class)->find($id);

                $new->addView($user);

                $entityManager->persist($new);

                $entityManager->flush();

                $response = new Response($status = Response::HTTP_ACCEPTED);
            } catch (Exception $e) {
                $response = new Response($status = Response::HTTP_NO_CONTENT);
            }
        }

        return $response;
    }
}