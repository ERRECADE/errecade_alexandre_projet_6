<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\FigureService;
class HomeController extends AbstractController
{
    /**
     * Page d'accueil
     * 
     * @Route("/" , name="home")
     */
    public function home(FigureService $FigureService)
    {
        $figures = $FigureService->ListFigures();
        return $this->render('home.html.twig',[
            'figures' => $figures,
        ]);
    }

}
