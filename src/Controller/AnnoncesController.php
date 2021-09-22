<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\User;
use App\Form\AnnoncesType;
use App\Repository\AnnoncesRepository;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use App\Form\AnnoncesSearchType;

/**
 * @Route("/annonces")
 */
class AnnoncesController extends AbstractController
{
    /**
     * @Route("/", name="annonces_index", methods={"GET"})
     */
    public function index(AnnoncesRepository $annoncesRepository): Response
    {
        return $this->render('annonces/index.html.twig', [
            'annonces' => $annoncesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="annonces_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        $annonce = new Annonces();
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setDateCreation(new DateTime());

            $file1 = $form->get('img1')->getData();
            $fileName = md5(uniqid()) . '.' . $file1->guessExtension();
            $file1->move($this->getParameter('upload_directory'), $fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $annonce->setImg1($fileName);

            $file = $form->get('img2')->getData();
            if (isset($file)) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $annonce->setImg2($fileName);
            }
            $file = $form->get('img3')->getData();
            if (isset($file)) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $annonce->setImg3($fileName);
            }

            $file = $form->get('img4')->getData();
            if (isset($file)) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $annonce->setImg4($fileName);
            }


            // pour faire des tests sur les annonces on creer le user en dur
            //TODO modifier pour recuperer le this->getUser;
          
            $annonce->setUser($this->getUser());
            
            $entityManager->persist($annonce);
            $entityManager->flush(); 

            return $this->redirectToRoute('annonces_index');
        }

        return $this->render('annonces/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/api/search/{query}", methods={"GET"})
     */
    public function search($query, AnnoncesRepository $annonceRepository, LoggerInterface $logger)
    {
        //$this->denyAccessUnlessGranted("ROLE_USER");

        // $listAuteur = $auteurRepository->findBy(array(), array('nom' => 'DESC'));
        // $listAuteur = $auteurRepository->findAllArray();

        // $listAuteur = $auteurRepository->findAllArrayWithBooks($query);
        $annonce = $annonceRepository->findAllArray($query);
        
        $logger->info($query);


        // return $this->json($listAuteur);
        
        return new JsonResponse($annonce);
    }

    //========================== recherche filter =====================================================
    /**
     * @Route("/filter", name="filter_annonces", methods={"GET","POST"})
     */
    public function filter(AnnoncesRepository $annoncesRepository, Request $request): Response
    {
        $annonce = new Annonces();
        $form = $this->createForm(AnnoncesSearchType::class);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
           
            $em = $this->getDoctrine()->getManager();
            $queryBuilder = $em->createQueryBuilder();
            $queryBuilder->select('a')->from(Annonces::class,'a');

            if (!empty($request->request->get('annonces_search')['prix'])) {
                $prix = $request->request->get('annonces_search')['prix'];
                $queryBuilder->andwhere('a.prix <= :prix')
                    ->setParameter('prix',  $prix);
            }
            if (!empty($request->request->get('annonces_search')['animaux'][0])) {
                $animaux = $request->request->get('annonces_search')['animaux'][0];
                $queryBuilder->andwhere('a.animaux = :animaux')
                    ->setParameter('animaux',  $animaux);
            }
            if (!empty($request->request->get('annonces_search')['fumeur'][0])) {
                $fumeur = $request->request->get('annonces_search')['fumeur'][0];
                $queryBuilder->andwhere('a.fumeur = :fumeur')
                    ->setParameter('fumeur',  $fumeur);
            }
            if (!empty($request->request->get('annonces_search')['pref_genre'])) {
                $pref_genre = $request->request->get('annonces_search')['pref_genre'];
                if(count($pref_genre) > 2){
                    $queryBuilder->andwhere('a.pref_genre =:pref_genre')
                    ->orWhere('a.pref_genre =:pref_genre2')
                    ->orWhere('a.pref_genre =:pref_genre3')
                    ->setParameter('pref_genre',  $pref_genre[0])
                    ->setParameter('pref_genre2',  $pref_genre[1])
                    ->setParameter('pref_genre3',  $pref_genre[2]);
                }
               else {
                    $queryBuilder->andwhere('a.pref_genre =:pref_genre')
                    ->setParameter('pref_genre',  $pref_genre[0]);
                }
            }
            if (!empty($request->request->get('annonces_search')['type_logement'])) {
                $type_logement = $request->request->get('annonces_search')['type_logement'];
              
                if(count($type_logement) > 1){
                    $queryBuilder->andwhere('a.type_logement = :type_logement ')
                    ->orWhere('a.type_logement = :type_logement_2 ')
                    ->setParameter('type_logement',  $type_logement[0])
                    ->setParameter('type_logement_2',  $type_logement[1]);
                }else{
                    $queryBuilder->andwhere('a.type_logement = :type_logement')
                    ->setParameter('type_logement',  $type_logement[0]);
                }
            } 
            if (!empty($request->request->get('annonces_search')['ville'])) {
                $ville = $request->request->get('annonces_search')['ville'];
                $queryBuilder->andwhere('a.ville LIKE :ville')
                    ->setParameter('ville','%' . $ville . '%');
            }
            if (!empty($request->request->get('annonces_search')['spf_chambre'])) {
                $spf_chambre = $request->request->get('annonces_search')['spf_chambre'];
                $queryBuilder->andwhere('a.spf_chambre >= :spf_chambre')
                    ->setParameter('spf_chambre',  $spf_chambre);
            }
            
            if (!empty($request->request->get('annonces_search')['superficie'])) {
                $superficie = $request->request->get('annonces_search')['superficie'];
                $queryBuilder->andwhere('a.superficie >= :superficie')
                    ->setParameter('superficie',  $superficie);
            }

            $query = $queryBuilder->getQuery();

            $data = $query->getResult();
        
        }else {
            $data = $annoncesRepository->findAll();
        }
        
        return $this->render('annonces/filter-annonce.html.twig', [
            /* 'annonces' => $annonce, */
            'form' => $form->createView(),
            'annonces' => $data
        ]);
    
        if ($form->isSubmitted() && $form->isValid()) {
           
            $em = $this->getDoctrine()->getManager();
            $queryBuilder = $em->createQueryBuilder();
            $queryBuilder->select('a')->from(Annonces::class,'a');

            if (!empty($request->request->get('annonces_search')['prix'])) {
                $prix = $request->request->get('annonces_search')['prix'];
                $queryBuilder->andwhere('a.prix <= :prix')
                    ->setParameter('prix',  $prix);
            }
            if (!empty($request->request->get('annonces_search')['animaux'][0])) {
                $animaux = $request->request->get('annonces_search')['animaux'][0];
                $queryBuilder->andwhere('a.animaux = :animaux')
                    ->setParameter('animaux',  $animaux);
            }
            if (!empty($request->request->get('annonces_search')['fumeur'][0])) {
                $fumeur = $request->request->get('annonces_search')['fumeur'][0];
                $queryBuilder->andwhere('a.fumeur = :fumeur')
                    ->setParameter('fumeur',  $fumeur);
            }
            if (!empty($request->request->get('annonces_search')['pref_genre'])) {
                $pref_genre = $request->request->get('annonces_search')['pref_genre'];
                if(count($pref_genre) > 2){
                    $queryBuilder->andwhere('a.pref_genre =:pref_genre')
                    ->orWhere('a.pref_genre =:pref_genre2')
                    ->orWhere('a.pref_genre =:pref_genre3')
                    ->setParameter('pref_genre',  $pref_genre[0])
                    ->setParameter('pref_genre2',  $pref_genre[1])
                    ->setParameter('pref_genre3',  $pref_genre[2]);
                }
               else {
                    $queryBuilder->andwhere('a.pref_genre =:pref_genre')
                    ->setParameter('pref_genre',  $pref_genre[0]);
                }
            }
            if (!empty($request->request->get('annonces_search')['type_logement'])) {
                $type_logement = $request->request->get('annonces_search')['type_logement'];
              
                if(count($type_logement) > 1){
                    $queryBuilder->andwhere('a.type_logement = :type_logement ')
                    ->orWhere('a.type_logement = :type_logement_2 ')
                    ->setParameter('type_logement',  $type_logement[0])
                    ->setParameter('type_logement_2',  $type_logement[1]);
                }else{
                    $queryBuilder->andwhere('a.type_logement = :type_logement')
                    ->setParameter('type_logement',  $type_logement[0]);
                }
            } 
            if (!empty($request->request->get('annonces_search')['ville'])) {
                $ville = $request->request->get('annonces_search')['ville'];
                $queryBuilder->andwhere('a.ville LIKE :ville')
                    ->setParameter('ville','%' . $ville . '%');
            }
            if (!empty($request->request->get('annonces_search')['spf_chambre'])) {
                $spf_chambre = $request->request->get('annonces_search')['spf_chambre'];
                $queryBuilder->andwhere('a.spf_chambre >= :spf_chambre')
                    ->setParameter('spf_chambre',  $spf_chambre);
            }
            
            if (!empty($request->request->get('annonces_search')['superficie'])) {
                $superficie = $request->request->get('annonces_search')['superficie'];
                $queryBuilder->andwhere('a.superficie >= :superficie')
                    ->setParameter('superficie',  $superficie);
            }

            $query = $queryBuilder->getQuery();

            $data = $query->getResult();
        
        }else {
            $data = $annoncesRepository->findAll();
        }
        
        return $this->render('annonces/filter-annonce.html.twig', [
            /* 'annonces' => $annonce, */
            'form' => $form->createView(),
            'annonces' => $data
        ]);
    }


    /**
     * @Route("/{id}", name="annonces_show", methods={"GET"})
     */
    public function show(Annonces $annonce): Response
    {
        return $this->render('annonces/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="annonces_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Annonces $annonce): Response
    {
        $this->denyAccessUnlessGranted("ROLE_USER");
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setDateCreation(new DateTime());

            $file = $form->get('img1')->getData();
            if (isset($file)) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $annonce->setImg1($fileName);
            }

            $file = $form->get('img2')->getData();
            if (isset($file)) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $annonce->setImg2($fileName);
            }


            $file = $form->get('img3')->getData();
            if (isset($file)) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $annonce->setImg3($fileName);
            }

            $file = $form->get('img4')->getData();
            if (isset($file)) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('upload_directory'), $fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $annonce->setImg4($fileName);
            }


            $annonce->setUser($this->getUser());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annonces_index');
        }

        return $this->render('annonces/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="annonces_delete", methods={"POST"})
     */
    public function delete(Request $request, Annonces $annonce): Response
    {
        
        if ($this->isCsrfTokenValid('delete' . $annonce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($annonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('annonces_index');
    }

    
}
