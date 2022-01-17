<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PhotoRepository;
use App\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Photo
{
    use Timestampable;    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Trick::class, inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trick;

    public function setTrick(?Trick $trick) 
    {
        $this->trick = $trick;
        return $this;
    }

    public function getTrick(): ?Trick
    {
        return $this->trick;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
