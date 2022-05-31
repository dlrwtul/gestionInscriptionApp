<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Repository\ProfesseurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'app_professeur')]
    public function index(ProfesseurRepository $repo,PaginatorInterface $paginator,Request $request): Response
    {
        $professeurs = $repo->findAll();
        $pagination = $paginator->paginate(
            $professeurs, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController',
            "professeurs" => $pagination
        ]);
    }
}
