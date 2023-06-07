<?php

namespace App\Service;

use \Doctrine\ORM\EntityManagerInterface;
use App\Repository\FigureRepository;
use App\Repository\UserRepository;
use App\Entity\Figure;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class FigureService
{
    private $figureRepository;

    public function __construct(FigureRepository $FigureRepository)
    {
        $this->figureRepository = $FigureRepository;
    }

    // affiche toutes les figures 
    public function ListFigures()
    {
       $allFigures = $this->figureRepository->findAll();
       return $allFigures;
    }
}