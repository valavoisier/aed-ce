<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlanningTarifsController extends AbstractController
{
    #[Route('/planning/tarifs', name: 'app_planning_tarifs')]
    public function index(): Response
    {
        return $this->render('planning_tarifs/index.html.twig');
    }
}
