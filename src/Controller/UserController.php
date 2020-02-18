<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\My\UserType as MyUserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface; 
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\FormError;
use Symfony\Contracts\Translation\TranslatorInterface;
/**
 * @Route("/user") 
 */
class UserController extends AbstractController
{
    /**
     * @var TranslatorInterface
     */
    private $translator;
    
    private  $passwordEncoder;
    
    public function __construct(TranslatorInterface  $translator,UserPasswordEncoderInterface $passwordEncoder)
    {     
        $this->passwordEncoder = $passwordEncoder;    
        $this->translator = $translator;    
        
    }
    
    /**
     * @Route("/", name="user_index", methods={"GET"})
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user,[
         //   'validation_groups' => ['registration']
        ]);
        $form->handleRequest($request);
  
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();       
            $user->setPassword($this->passwordEncoder->encodePassword($user,$form->get('password')->getData()));        
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    
    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($password=$form->get('password')->getData()){                
                $user->setPassword($this->passwordEncoder->encodePassword($user,$password));
            }
            
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    
    
    
    
    /**
     * @Route("/changePassword", name="user_changePassword", methods={"GET","POST"})
     * @IsGranted({"ROLE_USER"})
     */
    public function user_changePassword(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(MyUserType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $passwordOld = $form->get('passwordOld')->getData();
           
            
            if($this->passwordEncoder->isPasswordValid($user, $passwordOld)){
            
                if( $passwordNew = $form->get('passwordNew')->getData()){
                    $user->setPassword($this->passwordEncoder->encodePassword($user,$passwordNew));
                }
                
                $this->getDoctrine()->getManager()->flush();
                
                $this->addFlash('warning', $this->translator->trans('Your password has been updated'));
                return $this->redirectToRoute('user_changePassword');
            }
            else {
                $form->addError(new FormError($this->translator->trans('You password is not correct')));
                return $this->render('user/my/edit.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
            
        }
        
        return $this->render('user/my/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }
    
    
    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     * @IsGranted({"ROLE_ADMIN"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }
        
        return $this->redirectToRoute('user_index');
    }
 
}
