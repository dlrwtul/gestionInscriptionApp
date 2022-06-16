<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ProfesseurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/professeur')]

class ProfesseurController extends AbstractController
{
    #[Route('/', name: 'app_professeur_index')]
    public function index(ProfesseurRepository $repo,PaginatorInterface $paginator,Request $request): Response
    {
        $pagination = $this->findForPaginate($repo,$request,$paginator,10);
        return $this->render('professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController',
            "professeurs" => $pagination
        ]);
    }

    #[Route('/new', name: 'app_professeur_new')]
    public function new(Request $request,ProfesseurRepository $repo): Response
    {
        $professeur = new Professeur();
        $form = $this->createForm(ProfesseurType::class, $professeur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repo->add($professeur, true);
            $this->addFlash('success', 'Nouveau professeur ajoutée!');
            return $this->redirectToRoute('app_professeur_index',[], Response::HTTP_SEE_OTHER);
            /* $findClasse = $repo->findBy(["libelle" => $professeur->getLibelle()]);
            if ($findClasse == []) {
                $repo->add($professeur, true);
                $this->addFlash('success', 'Classe crée!');
                return $this->redirectToRoute('app_classe_index',[], Response::HTTP_SEE_OTHER);
            } else {
                $form = $this->createForm(ClasseType::class, $professeur);
                $this->addFlash('error', 'Classe deja existante!');
            } */
            
            
        }

        return $this->renderForm('professeur/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_professeur_edit')]
    public function edit(Request $request,Professeur $professeur ,ProfesseurRepository $repo)
    {
        $form = $this->createForm(ProfesseurType::class, $professeur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repo->add($professeur, true);
            $this->addFlash('success', 'Professeur modifié!');
            return $this->redirectToRoute('app_professeur_index',[], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('professeur/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_professeur_show', methods: ['GET'])]
    public function show(Professeur $professeur): Response
    {
        return $this->render('professeur/details.html.twig', [
            'professeur' => $professeur,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_professeur_delete')]
    public function delete(Request $request,Professeur $professeur ,ProfesseurRepository $repo)
    {
        $repo->remove($professeur, true);
        $this->addFlash('success', 'Professeur supprimée!');
        return $this->redirectToRoute('app_professeur_index', [], Response::HTTP_SEE_OTHER);
    }

}
