<?php

namespace App\Controller;

use App\Repository\TarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlanningTarifsController extends AbstractController
{
    #[Route('/planning/tarifs', name: 'app_planning_tarifs')]
    public function index(TarifRepository $repo): Response
    {
        return $this->render('planning_tarifs/index.html.twig', [
            'centreEquestre' => $repo->findByCategorie('centre_equestre'),
            'stageCheval' => $repo->findByCategorie('stage_cheval'),
            'poneyClub' => $repo->findByCategorie('poney_club'),
            'stagePoney' => $repo->findByCategorie('stage_poney'),
            'pension' => $repo->findByCategorie('pension'),
        ]);
    }
}
