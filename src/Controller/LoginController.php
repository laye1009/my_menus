<?php

namespace App\Controller;

use App\Form\CustomersType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $utils): Response
    {
        $error = $utils->getLastAuthenticationError();
        $lastusername = $utils->getLastUserName();
        $form = $this->createForm(CustomersType::class);

        return $this->render('login/login.html.twig', [
            'last_username'=>$lastusername,
            'error'=> $error,
            'form'=>$form->createView(),
        ]);
    }

    
    /**
     *
     * @Route("/logout", name="app_logout")
     *
     * @return void
     */
    public function logout(){

    }
}
