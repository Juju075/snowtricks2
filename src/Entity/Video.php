<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VideoRepository;
use App\Entity\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=VideoRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Video
{
    use Timestampable;    
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $embedded;

    /**
     * @ORM\ManyToOne(targetEntity=Trick::class, inversedBy="videos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trick;

    public function setTrick(?Trick $trick) 
    {
        $this->trick = $trick;
        return $this;
    }

    public function getTrick(): ?int
    {
        return $this->trick;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmbedded(): ?string
    {
        return $this->embedded;
    }

    public function setEmbedded(?string $embedded): self
    {
        $this->embedded = $embedded;

        return $this;
    }

    public function getVideo(): ?Trick
    {
        return $this->video;
    }

    public function setVideo(?Trick $video): self
    {
        $this->video = $video;

        return $this;
    }
}
