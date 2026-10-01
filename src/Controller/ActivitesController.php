<?php

namespace App\Controller;

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
    public function poneyClub(): Response
    {
        return $this->render('activites/poney-club.html.twig');
    }

    #[Route('/activites/cours-chevaux', name: 'app_activites_cours_chevaux')]
    public function coursChevaux(): Response
    {
        return $this->render('activites/cours-chevaux.html.twig');
    }

    #[Route('/activites/pension', name: 'app_activites_pension')]
    public function pension(): Response
    {
        return $this->render('activites/pension.html.twig');
    }
}
