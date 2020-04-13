<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserType;
use Doctrine\DBAL\DBALException;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $user = new User();

        $form = $this->createForm(RegisterUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setRoles(['IS_AUTHENTICATED_ANONYMOUSLY']);

            //encode Password
            $user->setPassword(
                $userPasswordEncoder->encodePassword(
                    $user,
                    $user->getPassword()
                )
            );

            //set to database
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            //set success message
            $this->addFlash('success', 'Thank you ' . $user->getFirstName() . ' ' . $user->getLastName() . ' for register to our service!  We will contact you, as soon as you are ready for login');

            //return to login
            return $this->redirect($this->generateUrl('app_login'));
        }


        return $this->render('security/register.html.twig', ['registerForm' => $form->createView()]);
    }
}
