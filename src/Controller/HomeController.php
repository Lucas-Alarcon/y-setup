<?php

namespace App\Controller;

use App\Repository\SetupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SetupRepository $setupRepository)
    {
        return $this->render('index.html.twig', [
            'setups' => $setupRepository->latestSetupsReleased(),
        ]);
    }
}
