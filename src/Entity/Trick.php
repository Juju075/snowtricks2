<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\TrickRepository;
use App\Entity\Traits\Timestampable;

use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=TrickRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Trick
{
    use Timestampable;  
     
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="trick")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="trick", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="trick", orphanRemoval=true, cascade={"persist"})
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity=Video::class, mappedBy="trick", orphanRemoval=true, cascade={"persist"})
     */
    private $videos;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;  

    // //vas generer un slug base sur le titre $nom
    /**
     * @Gedmo\Slug(fields={"nom"})
     * @ORM\Column(type="string", length=255)
     */
    protected $slug;


    //a l'instantation d'un trick on cree automatiquement une collection de comment vide [].
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->videos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }
    
    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        
        return $this;
    }
    
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
    
    public function getDescription(): ?string
    {
        return $this->description;
    }
    
    

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function setuser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comments): self
    {
        if (!$this->comments->contains($comments)) {
            $this->comments[] = $comments;
            $comments->setTrick($this);
        }

        return $this;
    }

    public function removeComment(Comment $comments): self
    {
        if ($this->comments->removeElement($comments)) {
            // set the owning side to null (unless already changed)
            if ($comments->getTrick() === $this) {
                $comments->setTrick(null);
            }
        }

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhoto(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photos): self
    {
        if (!$this->photos->contains($photos)) {
            $this->photos[] = $photos;
            $photos->setPhoto($this);
        }
        return $this;
    }

    public function removePhoto(Photo $photos): self
    {
        if ($this->photos->removeElement($photos)) {
            // set the owning side to null (unless already changed)
            if ($photos->getPhoto() === $this) {
                $photos->setPhoto(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideo(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $videos): self
    {
        if (!$this->videos->contains($videos)) {
            $this->videos[] = $videos;
            $videos->setVideo($this);
        }

        return $this;
    }

    public function removeVideo(Video $videos): self
    {
        if ($this->videos->removeElement($videos)) {
            // set the owning side to null (unless already changed)
            if ($videos->getVideo() === $this) {
                $videos->setVideo(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }    
}
