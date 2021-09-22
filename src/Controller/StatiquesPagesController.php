<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnnoncesRepository;
use App\Repository\UserRepository;
use APP\Entity\Annonces;
/**
 * @Route("/")
 */
class StatiquesPagesController extends AbstractController
{
    /**
     * @Route("/ccm", name="ccm", methods={"GET"})
     */
    public function ccm(AnnoncesRepository $annoncesRepository, UserRepository $userRepository): Response
    {
        return $this->render('statiques/ccm.html.twig', [
            'controller_name' => 'StatiquesPagesController',
        ]);
    }

    /**
     * @Route("/colocations", name="colocations", methods={"GET"})
     */
    public function colocations(AnnoncesRepository $annoncesRepository, UserRepository $userRepository): Response
    {
        return $this->render('statiques/colocations.html.twig', [
            'controller_name' => 'StatiquesPagesController',
        ]);
    }

    /**
     * @Route("/communaute", name="communaute", methods={"GET"})
     */
    public function communaute(AnnoncesRepository $annoncesRepository, UserRepository $userRepository): Response
    {
        return $this->render('statiques/communaute.html.twig', [
            'controller_name' => 'StatiquesPagesController',
        ]);
    }
    
        /**
     * @Route("/contacts", name="contacts", methods={"GET"})
     */
    public function contacts(AnnoncesRepository $annoncesRepository, UserRepository $userRepository): Response
    {
        return $this->render('statiques/contacts.html.twig', [
            'controller_name' => 'StatiquesPagesController',
        ]);
    }
}


