<?php

namespace App\Controller;

use App\Repository\StatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Random;
use DateTime;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(StatusRepository $statusRepository, Random $random): Response
    {
        $today = new DateTime("now");
        $status = $statusRepository->findOneById($random->random());

        return $this->render('home/index.html.twig', [
        'status' => $status]);
    }
}
