<?php

namespace App\Controller;

use App\Entity\Gare;
use App\Entity\Ligne;
use App\Entity\Station;
use Doctrine\ORM\Mapping\Id;
use App\Repository\GareRepository;
use App\Repository\LigneRepository;
use App\Repository\LigneStationsRepository;
use App\Repository\StationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{


    #[Route('/', name: 'app_home')]
    public function index(GareRepository $gareRepository,LigneRepository $ligneRepository,StationRepository $stationRepository,LigneStationsRepository $ligneStationsRepository): Response
    {


           

        return $this->render('home/index.html.twig', [

            'station' => $ligneStationsRepository->findAll()
        ]);
    }
}
