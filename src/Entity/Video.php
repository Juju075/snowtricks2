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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $embedded;

    /**
     * @ORM\ManyToOne(targetEntity=Trick::class, inversedBy="videos")
     */
    private $trick;

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
