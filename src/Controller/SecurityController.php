<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Security;


class SecurityController extends AbstractController
{
    
    private  $security;
    
    public function __construct(Security $security) {
        $this->security = $security;
    }
    
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            
            $user->setRoles(["ROLE_CUSTOMER"]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            $this->_authenticateUser($user);

            // do anything else you need here, like send an email

            return $this->redirectToRoute('product_index');
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
            'error'=>$form->getErrors(),
        ]);
    }
    /**
     * @Route("/login", name="app_login")
     */
    
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        
        $usr= $this->getUser();
       
        if($usr) {
            return $this->redirectToRoute('order_indexbelongsTo');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();   
        
        
        
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    
  
    /**
     * @Route("/", name="security_target_path")
     */
    public function security_target_path(): Response
    {  if($this->security->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('product_index');
        }
        else 
            return $this->redirectToRoute('order_indexbelongsTo');
        
    }
    
    
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): Response
    {
        return "";
        
    }
    
    private function _authenticateUser(User $user)
    {
        $providerKey = 'main';
        $token = new UsernamePasswordToken($user, null, $providerKey, $user->getRoles());
        $this->container->get('security.token_storage')->setToken($token);
    } 
}
