<?php

namespace App\Controller;

use App\Entity\History;
use App\Entity\User;
use App\Form\AnswerType;
use App\Repository\StatusRepository;
use App\Repository\UserRepository;
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
    public function index(StatusRepository $statusRepository, HistoryRepository $historyRepository, UserRepository $userRepository, Random $random, EntityManagerInterface $entityManager, Request $request): Response
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

        if ($request) {
            if ($request->get('answer') == $status->getCode()) {
                if ($userRepository->findOneByNickname($request->get('pseudo'))) {
                    $user = $userRepository->findOneByNickname($request->get('pseudo'));
                    if($user->getLastdateplayed()->format('d/m/Y') == $today->format('d/m/Y')) {
                        return $this->render('home/index.html.twig', [
                            'status' => $status
                        ]);
                    }
                } else {
                    $user = new User();
                    $user->setNickname($request->get('pseudo'));
                }
                $user->setGoodAnswers($user->getGoodAnswers() + 1);
                $user->setInARow($user->getInARow() + 1);
            }
            if ($request->get('answer') != $status->getCode()) {
                if ($userRepository->findOneByNickname($request->get('pseudo'))) {
                    $user = $userRepository->findOneByNickname($request->get('pseudo'));
                    if($user->getLastdateplayed()->format('d/m/Y') == $today->format('d/m/Y')) {
                        return $this->render('home/index.html.twig', [
                            'status' => $status
                        ]);
                    }
                } else {
                    $user = new User();
                }
                $user->setInARow(0);
            }
            $user->setTotalAnswers($user->getTotalAnswers() + 1);
            $user->setLastdateplayed($today);
            $entityManager->persist($user);
            $entityManager->flush($user);
        } else {

        }

        return $this->render('home/index.html.twig', [
            'status' => $status
        ]);
    }
}
