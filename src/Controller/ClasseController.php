<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
    public function index(ClasseRepository $repo,PaginatorInterface $paginator,Request $request): Response
    {
        $classes = $repo->findAll();
        $pagination = $paginator->paginate(
            $classes, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
        return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
            'classes' => $pagination
        ]);
    }
}
