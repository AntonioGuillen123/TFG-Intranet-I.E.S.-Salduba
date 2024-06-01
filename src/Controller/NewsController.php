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
use Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\String\Slugger\SluggerInterface;

class NewsController extends AbstractController
{
    public function index(SessionService $session, NewsRepository $newsRepository): Response
    {
        $username = $session->get('username');

        $news = $newsRepository->findAllNews();

        return $this->render('news/index.html.twig', [
            'username' => $username,
            'news' => $news,
        ]);
    }

    public function searchNew(Request $request, SessionService $session, NewsRepository $newsRepository): Response
    {
        $username = $session->get('username');

        $input = $request->request->get('input');

        $news = $newsRepository->findSearchNews($input);

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

                $newNews->setUserFrom($userFrom);
                $newNews->setPublishDate(new \DateTime());
                $newNews->setViews(0);

                $entityManager->persist($newNews);

                $entityManager->flush();
            } catch (Exception $e) {
                error_log('Error' . $e);
            }

            $image = $newNews->getImage();

            var_dump($image);
        }

        //return $this->render('news/index.html.twig');

        return $this->redirectToRoute('getNews');
    }
}
