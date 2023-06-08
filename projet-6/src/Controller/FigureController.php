<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Entity\Figure;
use App\Entity\Media;
use App\Form\Type\addFigureType;
use App\Repository\FigureRepository;
use DateTime;
/**
 * @Route("/figure", name="figure_")
 */
class FigureController extends AbstractController
{
    /**
     * Page de création
     * 
     * @Route("/create" , name="create")
     */
    public function createFigure(Request $request,FigureRepository $figuresRepository)
    {
        $directoryPhoto = realpath(__DIR__ . '/../../public/uploads/photos');
        $date = new DateTime;
        $user = $this->getUser();
        $figures = new Figure();
        $form = $this->createForm(addFigureType::class, $figures);
        $form->handleRequest($request);
        $figures->setUser($user);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('medias')->get(0)->get('picture')->getData() != null) {
                $medias = $form->get('medias');

                for ($i = 0; $i < count($medias); $i++) {
                    $pictureForm = $medias[$i]->get('picture');
                    $photoFile = $pictureForm->getData();

                    if ($photoFile instanceof UploadedFile && $photoFile->isValid()) {
                        $newFilename = uniqid() . '.' . $photoFile->getClientOriginalExtension();
                        $photoFile->move($directoryPhoto, $newFilename);

                        $mediaEntity = $figures->getMedias()[$i];
                        $mediaEntity->setPicture($newFilename);
                    }
                }
                
            }

            $figures->setCreatedAt($date);
            $figuresRepository->add($figures, true);
            return $this->redirectToRoute('home');
        }
        return $this->render('creationFigure.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    
    
    /**
     * Afficher les détails d'une figure
     *
     * @Route("/detail/{id}", name="detail")
     */
    public function detailsFigure($id, FigureRepository $figureRepository)
    {
        $figure = $figureRepository->findOneByFigures($id);
    
        return $this->render('details.html.twig', array(
            'figure' => $figure
        ));
    }

}
