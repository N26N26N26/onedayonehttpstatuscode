<?php

namespace App\Controller;

use App\Entity\History;
use App\Repository\StatusRepository;
use App\Repository\HistoryRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Random;
use DateTime;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(StatusRepository $statusRepository, HistoryRepository $historyRepository, Random $random, EntityManagerInterface $entityManager): Response
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

        return $this->render('home/index.html.twig', [
            'status' => $status
        ]);
    }
}
