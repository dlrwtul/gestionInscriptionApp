<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Repository\UserRepository;
use App\Repository\EtudiantRepository;
use App\Repository\InscriptionRepository;
use App\Repository\AnneeScolaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Container8AKQFJy\getInscriptionTypeService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/inscription')]

class InscriptionController extends AbstractController
{

     /**
     * @var UserPasswordHasherInterface
     */
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder) {
        $this->encoder = $encoder;
    }

    #[Route('/', name: 'app_inscription_index')]
    public function index(InscriptionRepository $repo,PaginatorInterface $paginator,Request $request): Response
    {
        $pagination = $this->findForPaginate($repo,$request,$paginator,10);
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
            "inscriptions" => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_inscription_new')]
    public function new(Request $request,UserRepository $usrepo,InscriptionRepository $repo,AnneeScolaireRepository $anrepo,Session $session): Response
    {
        $inscription = new Inscription();
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($usrepo->findBy(["login" => $inscription->getEtudiant()->getLogin()]) == null) {
                $hashed = $this->encoder->hashPassword($inscription->getEtudiant(),substr($inscription->getEtudiant()->getMatricule(),0,6));
                $inscription->getEtudiant()->setPassword($hashed);
                $inscription->setAnneeScolaire($anrepo->findOneBy(["etat" => "en cours"]));
                $repo->add($inscription, true);
                $this->addFlash('success', 'Inscription Reussie!');
            } else {
                $form = $this->createForm(InscriptionType::class, $inscription);
                $this->addFlash('error', 'Login existant !(reinscription ?)');
            }
            
            
            return $this->redirectToRoute('app_inscription_new',[], Response::HTTP_SEE_OTHER); 
        }

        return $this->renderForm('inscription/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/new-re', name: 'app_inscription_new_re')]
    public function new_re(Request $request,UserRepository $usrepo,InscriptionRepository $repo,EtudiantRepository $etrepo,AnneeScolaireRepository $anrepo,Session $session): Response
    {
        $verify = false;
        $inscription = new Inscription();
        $info =[];
        if (isset($request->request->all()['matricule'])) {
            if ($request->request->all()['matricule'] != "") {
                $mat = $request->request->all()['matricule'];
                $etudiant = $etrepo->findOneBy(['matricule' => $mat]);
                if ($etudiant == null) {
                    $this->addFlash('error', 'Matricule inexistant!');
                } else {
                    $inscription = $repo->findOneBy(["etudiant" => $etudiant],["id" => "DESC"]);
                    $info = array('lastYear' => $inscription->getAnneeScolaire(),'lastClasse' => $inscription->getClasse());
                    $verify = true;
                }
            }
        }

        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $insc = new Inscription();
            $insc->setDate($inscription->getDate())
                 ->setClasse($inscription->getClasse())
                 ->setEtudiant($usrepo->findOneBy(array('login' => $inscription->getEtudiant()->getLogin())))
                 ->setAnneeScolaire($anrepo->findOneBy(["etat" => "en cours"]));
            $repo->add($insc, true);
            $this->addFlash('success', 'ReInscription Reussie!');
            return $this->redirectToRoute('app_inscription_new_re',[], Response::HTTP_SEE_OTHER); 
        }

        return $this->renderForm('inscription/new2.html.twig', [
            'form' => $form,
            'verify' => $verify,
            'info' => $info,
        ]);
    }

    public function findForPaginate($repo ,Request $request,PaginatorInterface $paginator,$parPage)
    {
        $objects = $repo->InscriptionAnneeEnCours();
        $pagination = $paginator->paginate(
            $objects,
            $request->query->getInt('page', 1),
            $parPage
        );  

        return $pagination;
    } 
}
