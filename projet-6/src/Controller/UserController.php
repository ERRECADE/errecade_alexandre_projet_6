<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Type\UserType;
use App\Form\Type\UserMailType;
use App\Form\Type\UserUpdateMdpType;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Event\LogoutEvent;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\MailerService;

/**
 * @Route("/user", name="user_")
 */
class UserController extends AbstractController
{

    /**
     * Page de connexion
     * 
     * @Route("/connexion" , name="connexion")
     */
    public function userConnexion(AuthenticationUtils $authenticationUtils): Response
    {

        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('connexion.html.twig', [
            'controller_name' => 'UserController',
            'last_username' => $lastUsername,
            'error'         => $error,
          ]);
    }
    public static function getSubscribedEvents(): array
    {
        return [LogoutEvent::class => 'logout'];
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout(UrlGeneratorInterface $urlGenerator, LogoutEvent $event)
    {
           $token = $event->getToken();
           $request = $event->getRequest();
           $response = $event->getResponse();
           // configure a custom logout response to the homepage
           $response = new RedirectResponse(
               $urlGenerator->generate('home'),
               RedirectResponse::HTTP_SEE_OTHER
           );
           $event->setResponse($response);
       
    }

     /**
     * Page d'inscription
     * 
     * @Route("/inscription" , name="inscription")
     */
    public function newFormulaireInscription(Request $request, UserRepository $UserRepository,UserPasswordHasherInterface $passwordHasher)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plainPassword
            );
            $user->setPassword($hashedPassword);
            $UserRepository->add($user,true);
            return $this->redirectToRoute('user_connexion');
        }
    

        return $this->render('inscription.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * 
 * @Route("/forgottenPassword", name="mdp_mail")
 */
public function forgottenPassword(Request $request, MailerService $MailerService,UrlGeneratorInterface $urlGenerator,UserRepository $userRepository)
{
    $form = $this->createForm(UserMailType::class);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        //$route = $this->generateUrl('user_mdp_reset');
        $mail = $form->getData()->getMail(); 
        $user = $userRepository->findOneBy(['mail' => $mail]);

        $token = base64_encode($user->getMail());
        $user->setToken($token);
        $userRepository->add($user,true);

        $route = new RedirectResponse(
            $urlGenerator->generate('user_mdp_reset',['token' => $token],UrlGeneratorInterface::ABSOLUTE_URL),
            RedirectResponse::HTTP_CREATED
        );
        $params = [
            'from' => 'alex.errecade@hotmail.com',
            'to' => $form->getData()->getMail(),
            'subject' => 'reset password',
            'text' => 'cliquez ici pour reset votre password ',
            'html' => $route->getContent()
        ];
        $MailerService->sendEmail($params);
        //return $this->redirectToRoute('home');
    }


    return $this->render('usermail.html.twig', array(
        'form' => $form->createView(),
    ));
}
/**
* 
 * @Route("/newPassword", name="mdp_reset")
 */
public function newPassword(Request $request ,UserRepository $UserRepository,UserPasswordHasherInterface $passwordHasher)
{
    $user = $UserRepository->findOneBy(['token' => $request->query->get('token')]);
    $form = $this->createForm(UserUpdateMdpType::class, $user);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $plainPassword = $form->get('password')->getData();
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plainPassword
        );
        $user->setPassword($hashedPassword);
        $UserRepository->add($user,true);
        return $this->redirectToRoute('user_connexion');
    }


    return $this->render('resetpassword.html.twig', array(
        'form' => $form->createView(),
    ));
}


}
