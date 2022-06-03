<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/classe')]
class ClasseController extends AbstractController
{
    #[Route('/', name: 'app_classe_index')]
    public function index(ClasseRepository $repo,PaginatorInterface $paginator,Request $request): Response
    {
        $pagination = $this->findForPaginate($repo,$request,$paginator,10);
        $this->addFlash('success', 'listed!');
        return $this->render('classe/index.html.twig', [
            'classes' => $pagination
        ]);
    }

    #[Route('/new', name: 'app_classe_new')]
    public function new(Request $request,ClasseRepository $repo): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repo->add($classe, true);
            $this->addFlash('success', 'Classe crée!');
            return $this->redirectToRoute('app_classe_index',[], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('classe/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_classe_edit')]
    public function edit(Request $request,Classe $classe ,ClasseRepository $repo)
    {
        $form = $this->createForm(ClasseType::class, $classe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repo->add($classe, true);
            $this->addFlash('success', 'Classe modifiée!');
            return $this->redirectToRoute('app_classe_index',[], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('classe/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_classe_delete')]
    public function delete(Request $request,Classe $classe ,ClasseRepository $repo)
    {
        $repo->remove($classe, true);
        $this->addFlash('success', 'Classe supprimée!');
        return $this->redirectToRoute('app_classe_index', [], Response::HTTP_SEE_OTHER);
    }

}
