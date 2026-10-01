<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/equi-handi', name: 'app_equi_handi')]
    public function equiHandi(): Response
    {
        return $this->render('page/equi-handi.html.twig');
    }

    #[Route('/infrastructures', name: 'app_infrastructures')]
    public function infrastructure(): Response
    {
        return $this->render('page/infrastructures.html.twig');
    }
}
