<?php

namespace App\Controller;

use App\Repository\TarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ActivitesController extends AbstractController
{
    #[Route('/activites', name: 'app_activites')]
    public function index(): Response
    {
        return $this->render('activites/index.html.twig');
    }

    #[Route('/activites/poney-club', name: 'app_activites_poney_club')]
    public function poneyClub(TarifRepository $repo): Response
    {
        return $this->render('activites/poney-club.html.twig', [
            'poneyClub' => $repo->findByCategorie('poney_club'),
            'stagePoney' => $repo->findByCategorie('stage_poney'),
        ]);
    }

    #[Route('/activites/cours-chevaux', name: 'app_activites_cours_chevaux')]
    public function coursChevaux(TarifRepository $repo): Response
    {
        return $this->render('activites/cours-chevaux.html.twig', [
            'centreEquestre' => $repo->findByCategorie('centre_equestre'),
            'stageCheval' => $repo->findByCategorie('stage_cheval'),
        ]);
    }

    #[Route('/activites/pension', name: 'app_activites_pension')]
    public function pension(TarifRepository $repo): Response
    {
        return $this->render('activites/pension.html.twig', [
            'pension' => $repo->findByCategorie('pension'),
        ]);
    }
}
