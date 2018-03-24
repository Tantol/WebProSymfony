<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\Entity\User;
use AppBundle\Entity\Group;
use AppBundle\Form\RegisterType;

class LoginAndRegisterControler extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        
        $errors = $authenticationUtils->getLastAuthenticationError();
        
        $lastUserName = $authenticationUtils->getLastUsername();
        
        return $this->render('login/login.html.twig', array(
            'errors' => $errors,
            'username' => $lastUserName,
        ));
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()  
    {
    }
    
    /**
     * @Route("/register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\Request
     * @internal param UserPasswordEncoderInterface #encoder
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = new User();
        
        $form = $this->createForm(RegisterType::class, $user);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            // Create the user
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
            $group = $em->getRepository('AppBundle:Group')->find(1);
            $user->addGroup($group);
            
            $em->persist($user);
            $em->flush();
            
            return $this->redirectToRoute('login');
        }
        
        return $this->render('register/register.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
