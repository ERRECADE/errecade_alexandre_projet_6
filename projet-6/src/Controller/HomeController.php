<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\FigureRepository;

class HomeController extends AbstractController
{
    /**
     * Page d'accueil
     *
     * @Route("/" , name="home")
     */
    public function home(FigureRepository $figureRepository, SessionInterface $session)
    {
        $figures = $figureRepository->findAllFigures();
        $successMessages = $session->getFlashBag()->get('success');
        $errorMessages = $session->getFlashBag()->get('error');
        return $this->render('home.html.twig', [
            'figures' => $figures,
            'successMessages' => $successMessages,
            'errorMessages' => $errorMessages,
        ]);
    }
}
