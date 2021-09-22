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
class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home_page", methods={"GET"})
     */
    public function index(AnnoncesRepository $annoncesRepository, UserRepository $userRepository): Response
    {

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            /* 'annonces' => $annoncesRepository->findAll(), */
            'annonces' => $annoncesRepository->findLimite(),
            'users' => $userRepository->findAll()
        ]);
    }

    /**
     * @Route("/voirplus", name="voirplus_page", methods={"GET"})
     */


    public function voirplus(AnnoncesRepository $annoncesRepository, UserRepository $userRepository): Response
    {
        return $this->render('voirplus_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'annonces' => $annoncesRepository->findAll(),
            'users' => $userRepository->findAll()
        ]);
    }

     /**
     * @Route("/register", name="app_register", methods={"GET"})
     */


    public function register(AnnoncesRepository $annoncesRepository, UserRepository $userRepository): Response
    {
        return $this->render('app_register/register.html.twig', [
            'controller_name' => 'HomePageController',
            'annonces' => $annoncesRepository->findAll(),
            'users' => $userRepository->findAll()
        ]);
    }
    
    
    //app_register

}


