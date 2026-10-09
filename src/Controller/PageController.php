<?php

namespace App\Controller;

use App\Repository\MoniteurRepository;
use App\Repository\TarifRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/equi-handi', name: 'app_equi_handi')]
    public function equiHandi(MoniteurRepository $repo,
TarifRepository $tarifRepo): Response
    {        
        $moniteurs = $repo->findAllOrdered();

        return $this->render('page/equi-handi.html.twig', [
            'moniteurs' => $repo->findAllOrdered(),
            'handi' => $tarifRepo->findByCategorie('handi'),
        ]);
    }

    #[Route('/infrastructures', name: 'app_infrastructures')]
    public function infrastructure(): Response
    {
        return $this->render('page/infrastructures.html.twig');
    }
}
