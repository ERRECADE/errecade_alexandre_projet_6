<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\AST\UpdateItem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass=MediaRepository::class)
 */
class Media
{
    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;
    private $file;


    /**
     * @ORM\ManyToOne(targetEntity=Figure::class, inversedBy="medias" , cascade={"persist", "remove"})
     */
    private $figure;

    public function __construct()
    {
         //$this->figure = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getFile(): ?UploadedFile
    {
        return $this->file;
    }

    public function setFile( ?UploadedFile $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getFigure(): ?Figure
    {
        return $this->figure;
    }
    
    public function setFigure(?Figure $figure): self
    {
        $this->figure = $figure;
    
        return $this;
    }
}
