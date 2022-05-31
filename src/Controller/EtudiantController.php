<?php

namespace App\Controller;

use App\Entity\Etudiant;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(): Response
    {
        $etudiant = new Etudiant;
        $etudiant->setNomComplet("lutwrld");
        $etudiant->setAdresse("KM");
        $etudiant->setSexe("M");
        dd($etudiant);
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }
}
