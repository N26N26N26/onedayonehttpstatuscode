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

        $winners = $userRepository->findByExampleField($today->format('Y/m/d'));

        $status = $historyRepository->findOneByDate($today)?->getStatus();

        $tomorrowQuestion = $historyRepository->findOneByDate($tomorrow)?->getStatus();

        // NEED TO FACTORIZE

        if ($request->get('answer') != "" && $request->get('pseudo') != "") {
            if ($request->get('answer') == $status->getCode()) {
                if ($userRepository->findOneByNickname($request->get('pseudo'))) {
                    $user = $userRepository->findOneByNickname($request->get('pseudo'));
                    if($user->getLastdateplayed()->format('d/m/Y') == $today->format('d/m/Y')) {
                        $this->addFlash('error', 'You already played today ! Try again tomorrow !');
                        return $this->render('home/index.html.twig', [
                            'status' => $status,
                            'winners' => $winners,
                            'tomorrowQuestion' => $tomorrowQuestion,
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
                    if($user->getLastdateplayed()->format('Y/m/d') == $today->format('Y/m/d')) {
                        $this->addFlash('error', 'You already played today ! Try again tomorrow !');

                        return $this->render('home/index.html.twig', [
                            'status' => $status,
                            'winners' => $winners,
                            'tomorrowQuestion' => $tomorrowQuestion,
                        ]);
                    }

                } else {
                    $user = new User();
                    $user->setNickname($request->get('pseudo'));
                    $user->setGoodAnswers(0);
                }
                $user->setTotalAnswers($user->getTotalAnswers() + 1);
                $user->setLastdateplayed($today);
                $user->setInARow(0);

                $entityManager->persist($user);
                $entityManager->flush($user);

                $this->addFlash('error', 'Wrong Answer ! Try again tomorrow !');
                return $this->render('home/index.html.twig', [
                    'status' => $status,
                    'winners' => $winners,
                    'tomorrowQuestion' => $tomorrowQuestion,
                ]);
            }
            $user->setTotalAnswers($user->getTotalAnswers() + 1);
            $user->setLastdateplayed($today);
            $entityManager->persist($user);
            $entityManager->flush($user);
        } else {
            return $this->render('home/index.html.twig', [
                'status' => $status,
                'winners' => $winners,
                'tomorrowQuestion' => $tomorrowQuestion,
            ]);
        }

        $this->addFlash('sucess', 'Good Answer ! Keep in row tomorrow !');
        return $this->render('home/index.html.twig', [
            'status' => $status,
            'winners' => $winners,
            'tomorrowQuestion' => $tomorrowQuestion,
        ]);
    }

    #[Route('/concept', name: 'concept')]
    public function showConcept(): Response
    {
        return $this->render('home/concept.html.twig')
    }

}
