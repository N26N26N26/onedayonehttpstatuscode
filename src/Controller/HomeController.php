<?php

namespace App\Controller;

use App\Entity\History;
use App\Form\AnswerType;
use App\Repository\StatusRepository;
use App\Repository\HistoryRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Random;
use DateTime;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(StatusRepository $statusRepository, HistoryRepository $historyRepository, Random $random, EntityManagerInterface $entityManager, Request $request): Response
    {
        $today = new DateTime("now");
        $tomorrow = new DateTime("tomorrow");

        if (!$historyRepository->findOneByDate($tomorrow)) {
            $newHistory = new History();
            $newHistory->setDate($tomorrow);
            $newHistory->setStatus($statusRepository->findOneById($random->random()));
            $entityManager->persist($newHistory);
            $entityManager->flush();
        }

        $status = $historyRepository->findOneByDate($today)?->getStatus();

        if ($request->get('answer') != "") {
            if ($request->get('answer') == $status->getCode()) {
                dd("OKAY");
            }
            if ($request->get('answer') != $status->getCode()) {
                dd("NOOKAY");
            }

        }

        return $this->render('home/index.html.twig', [
            'status' => $status
        ]);
    }
}
