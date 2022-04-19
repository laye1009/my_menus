<?php

namespace App\Controller;

use DateTime;
use App\Entity\Customers;
use App\Form\CustomersType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        /**
     * @Route("/account/create",name="account_create")
     */
    public function accountCreate(Request $request,UserPasswordEncoderInterface $encoder,ObjectManager $manager)
    {

        if($request->getMethod() == "POST")
        {
            $customer = new Customers();
            $firstname = $request->get('firstname');
            $lastname = $request->get('lastname');
            $email = $request->get('email');
            $password = $request->get('password');
            $join = new DateTime();
            //var_dump($join);die();
            //$joindate = $join->format('Y-m-d');
            $customer->setFirstName($firstname)
                ->setLastName($firstname)
                ->setEmail($email)
                ->setPassword($encoder->encodePassword($customer,$password))
                ->setAvatar('https://dummyimage.com/100')
                ->setJoinDate($join)
                ;
            $manager->persist($customer);
            $manager->flush();
            $this->addFlash('success','Votre compte a été créé');
            $this->redirectToRoute('app_login');
        }
        return $this->render('login/account_create.html.twig');
    }
}
