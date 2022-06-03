<?php

namespace App\Controller;

use Normalizer;
use App\Entity\Module;
use App\Form\ModuleType;
use PhpParser\Node\Stmt\Nop;
use App\Repository\ModuleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Polyfill\Intl\Normalizer\Normalizer as NormalizerNormalizer;

#[Route('/module')]
class ModuleController extends AbstractController
{
    #[Route('/', name: 'app_module_index', methods: ['GET'])]
    public function index(ModuleRepository $repo,PaginatorInterface $paginator,Request $request): Response
    {
        $pagination = $this->findForPaginate($repo,$request,$paginator,9);
        return $this->render('module/index.html.twig', [
            'modules' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_module_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ModuleRepository $moduleRepository): Response
    {
        $result = json_decode($request->request->all()['datas']);
        if ($result[0] != "") {
            $module = $moduleRepository->findBy(["libelle"=>$result[0]]);
            if ($module == []) {
                $module = new Module();
                $module->setLibelle($result[0]);
                $moduleRepository->add($module,true);
            } else {
                $this->addFlash('error', 'Module deja existant');
            }
        }

        return $this->redirectToRoute('app_module_index', [], Response::HTTP_SEE_OTHER);
        
    }

    #[Route('/{id}', name: 'app_module_show', methods: ['GET'])]
    public function show(Module $module): Response
    {
        return $this->render('module/show.html.twig', [
            'module' => $module,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_module_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Module $module, ModuleRepository $moduleRepository): Response
    {
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $moduleRepository->add($module, true);

            return $this->redirectToRoute('app_module_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('module/edit.html.twig', [
            'module' => $module,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_module_delete', methods: ['POST'])]
    public function delete(Request $request, Module $module, ModuleRepository $moduleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$module->getId(), $request->request->get('_token'))) {
            $moduleRepository->remove($module, true);
        }

        return $this->redirectToRoute('app_module_index', [], Response::HTTP_SEE_OTHER);
    }
}
