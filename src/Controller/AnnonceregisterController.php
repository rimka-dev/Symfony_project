<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Equipements;
use App\Entity\EquipementsAnnonces;
use App\Entity\LoisirsAnnonces;
use App\Entity\Loisirs;
use App\Form\AnnoncesLogement;
use App\Form\AnnoncesEquipements;
use App\Form\AnnoncesColocataires;
use App\Form\AnnoncesActivites;
use App\Form\AnnoncesPhotos;
use App\Form\AnnoncesValidation;
use App\Repository\EquipementsAnnoncesRepository;
use App\Repository\LoisirsAnnoncesRepository;
use App\Repository\EquipementsRepository;
use App\Repository\LoisirsRepository;
use DateTime;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * @Route("")
 */
class AnnonceregisterController extends AbstractController
{
    /**
     * @Route("/annonceregister/logement", name="annonceregisterlogement", methods={"GET","POST"})
     */
    public function logement(Request $request, Session $session): Response
    {
        $annonce = new Annonces();
        $form = $this->createForm(AnnoncesLogement::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {    
            $session->set("annonce", $annonce);
            return $this->redirectToRoute('annonceregisterequipements');
        }

        return $this->render('annonceregister/logement.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/annonceregister/equipements", name="annonceregisterequipements", methods={"GET","POST"})
     */
    public function equipements(Request $request, Session $session): Response
    {
        $annonce = $session->get("annonce");
        $form = $this->createForm(AnnoncesEquipements::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {          
            $session->set("annonce", $annonce);

            return $this->redirectToRoute('annonceregister/colocataires');
        }

        return $this->render('annonceregister/equipements.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/annonceregister/colocataires", name="annonceregistercolocataires", methods={"GET","POST"})
     */
    public function colocataires(Request $request, Session $session): Response
    {
        $annonce = $session->get("annonce");
        $form = $this->createForm(AnnoncesColocataires::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {          
            $session->set("annonce", $annonce);

            return $this->redirectToRoute('annonceregisteractivites');
        }

        return $this->render('annonceregister/colocataires.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/annonceregister/activites", name="annonceregisteractivites", methods={"GET","POST"})
     */
    public function activites(Request $request, Session $session): Response
    {
        $annonce = $session->get("annonce");
        $form = $this->createForm(AnnoncesActivites::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {          
            $session->set("annonce", $annonce);
            return $this->redirectToRoute('annonceregisterphotos');
        }

        return $this->render('annonceregister/activites.html.twig', [
            'form' => $form->createView()
        ]);
    }
        /**
     * @Route("/annonceregister/photos", name="annonceregisterphotos", methods={"GET","POST"})
     */
    public function photos(Request $request, Session $session): Response
    {
        $annonce = $session->get("annonce");
        $form = $this->createForm(AnnoncesPhotos::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file1 = $form->get('img1')->getData();
            $fileName = md5(uniqid()).'.'.$file1->guessExtension();
            $file1->move($this->getParameter('upload_directory'),$fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $annonce->setImg1($fileName);
            $file = $form->get('img2')->getData();

            $session->set("annonce", $annonce);
            return $this->redirectToRoute('annonceregistervalidation');

            if(isset($file))
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload_directory'),$fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $annonce->setImg2($fileName);
            }


            $file = $form->get('img3')->getData();
            if(isset($file))
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload_directory'),$fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $annonce->setImg3($fileName);
            }

            $file = $form->get('img4')->getData();
            if(isset($file))
            {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('upload_directory'),$fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $annonce->setImg4($fileName);
            }
        }
        return $this->render('annonceregister/photos.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/annonceregister/validation", name="annonceregistervalidation", methods={"GET","POST"})
     */
    public function validation(Request $request, Session $session): Response
    {
        $annonce = $session->get("annonce");

        return $this->render('annonceregister/validation.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    /**
     * @Route("/annonceregister/enregistrement", name="annonceregisterenregistrement", methods={"POST"})
     */
    public function enregistrement(
        Request $request, 
        Session $session, 
        EquipementsRepository $equipementsRepository, 
        EquipementsAnnoncesRepository $equipementsAnnoncesRepository, 
        LoisirsRepository $loisirsRepository, 
        LoisirsAnnoncesRepository $loisirsAnnoncesRepository
        ): Response
    {
        
        $annonce = $session->get("annonce");

        $annonce->setDateCreation(new DateTime());
        $annonce->setUser($this->getUser());

        $entityManager = $this->getDoctrine()->getManager();

        $annonceTemp = $annonce;

        $tabEquipement = array();
        foreach($annonceTemp->getEquipements() as $row){
            array_push($tabEquipement, $row->getId());
        }

        $tabLoisir = array();
        foreach($annonceTemp->getLoisirs() as $row){
            array_push($tabLoisir, $row->getId());
        }

        foreach($annonceTemp->getEquipements() as $row){
            $annonce->removeEquipement($row);
        };

        foreach($annonceTemp->getLoisirs() as $row){
            $annonce->removeLoisir($row);
        };

        $entityManager->persist($annonce);
        $entityManager->flush();

        foreach($tabEquipement as $key => $val){
            
            $equipement = $equipementsRepository->findOneById($val);

            $equipementsAnnonces = new EquipementsAnnonces();
            $equipementsAnnonces->setAnnonces($annonce);
            $equipementsAnnonces->setEquipements($equipement);

            $entityManager->persist($equipementsAnnonces);
            
        };

        foreach($tabLoisir as $key => $val){

            $loisir = $loisirsRepository->findOneById($val);

            $loisirsAnnonces = new LoisirsAnnonces();
            $loisirsAnnonces->setAnnonces($annonce);
            $loisirsAnnonces->setLoisirs($loisir);

            $entityManager->persist($loisirsAnnonces);
            
        };

        $entityManager->flush();

        $session->set('annonce', null);

        return $this->render('/annonces/index.html.twig', [
            'annonce' => $annonce,
        ]);
    }
}