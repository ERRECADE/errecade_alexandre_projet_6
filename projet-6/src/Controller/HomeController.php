<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\FigureRepository;
class HomeController extends AbstractController
{
    /**
     * Page d'accueil
     * 
     * @Route("/" , name="home")
     */
    public function home(FigureRepository $figureRepository)
    {
        $figures = $figureRepository->findAllFigures();
        return $this->render('home.html.twig',[
            'figures' => $figures
        ]);
    }

}
