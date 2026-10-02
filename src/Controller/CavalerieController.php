<?php

namespace App\Controller;

use App\Repository\CavalerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CavalerieController extends AbstractController
{
    #[Route('/cavalerie', name: 'app_cavalerie')]
    public function index(CavalerieRepository $repo): Response
    {
        $chevaux = $repo->findChevaux();
        $poneys  = $repo->findPoneys();

        return $this->render('cavalerie/index.html.twig', [
            'chevaux' => $chevaux,
            'poneys'  => $poneys,
        ]);
    }
}

