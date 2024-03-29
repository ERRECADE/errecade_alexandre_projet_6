<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use App\Helper\YoutubeHelper;
use Twig\Environment;
use App\Twig\YouTubeExtension;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Figure;
use App\Entity\Media;
use App\Entity\Commentary;
use App\Form\Type\addFigureType;
use App\Form\Type\CommentaryType;
use App\Repository\FigureRepository;
use App\Repository\CommentaryRepository;
use DateTime;

/**
 * @Route("/figure", name="figure_")
 */
class FigureController extends AbstractController
{
    private $youtubeHelper;
    public function __construct(YoutubeHelper $youtubeHelper)
    {
        $this->youtubeHelper = $youtubeHelper;
    }
    /**
     * Page de création
     *
     * @Route("/create" , name="create")
     */
    public function createFigure(Request $request, FigureRepository $figuresRepository, SessionInterface $session)
    {
        $directoryPhoto = realpath(__DIR__ . '/../../public/uploads/photos');
        $figure = new Figure();
        $form = $this->createForm(addFigureType::class, $figure);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $figure->setUser($this->getUser());
            foreach ($figure->getPictures() as $picture) {
                if ($picture->getFile() instanceof UploadedFile && $picture->getFile()->isValid()) {
                    $newFilename = uniqid() . '.' . $picture->getFile()->getClientOriginalExtension();
                    $picture->getFile()->move($directoryPhoto, $newFilename);
                    $picture->setLink($newFilename);
                }
            }
            $figuresRepository->add($figure, true);
            $session->getFlashBag()->add('success', 'La figure a été créée avec succès.');
            return $this->redirectToRoute('home');
        }
        return $this->render('creationFigure.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Update figure
     *
     * @Route("/update/{id}", name="update")
     */
    public function updateFigure($id, Request $request, FigureRepository $figuresRepository, EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $figure = $figuresRepository->find($id);
        $directoryPhoto = realpath(__DIR__ . '/../../public/uploads/photos');
        $editForm = $this->createForm(addFigureType::class, $figure);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            foreach ($figure->getPictures() as $picture) {
                if ($picture->getFile() instanceof UploadedFile && $picture->getFile()->isValid()) {
                    $newFilename = uniqid() . '.' . $picture->getFile()->getClientOriginalExtension();
                    $picture->getFile()->move($directoryPhoto, $newFilename);
                    $picture->setLink($newFilename);
                }
            }
            $entityManager->flush();
            $session->getFlashBag()->add('success', 'La figure a été modifier avec succès.');
            return $this->redirectToRoute('figure_update', ['id' => $id]);
        }
        return $this->render('creationFigure.html.twig', array(
            'form' => $editForm->createView(),
            'figure' => $figure
        ));
    }

    /**
     * delete figure
     *
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteFigure($id, FigureRepository $figureRepository, SessionInterface $session)
    {
        $figure = $figureRepository->find($id);
        $figureRepository->remove($figure, true);
        $session->getFlashBag()->add('success', 'La figure a été suprimer avec succès.');
        return $this->redirectToRoute('home');
    }

    /**
     * Afficher les détails d'une figure
     *
     * @Route("/detail/{id}", name="detail")
     */
    public function detailsFigure($id, FigureRepository $figureRepository, CommentaryRepository $commentaryRepository, Request $request)
    {

        $figure = $figureRepository->findOneByFigures($id);
        $comme = new Commentary();
        $form = $this->createForm(CommentaryType::class, $comme);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->getUser()) {
                $comme->setUser($this->getUser());
            } else {
                $comme->setUser(null);
            }
            $comme->setFigure($figure);
            $commentaryRepository->add($comme, true);
            return $this->redirectToRoute('figure_detail', ['id' => $id]);
        }
        $page = $request->query->getInt('page', 1);
        $limit = 10;
        $query = $commentaryRepository->createQueryBuilder('c')->andWhere('c.figure = :figure')->setParameter('figure', $figure)->orderBy('c.createdAt', 'DESC');
        $paginator = new Paginator($query);
        $totalItems = count($paginator);
        $totalPages = ceil($totalItems / $limit);
        $paginator
            ->getQuery()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);
        return $this->render('details.html.twig', array(
            'figure' => $figure,
            'form' => $form->createView(),
            'paginator' => $paginator,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ));
    }
}
