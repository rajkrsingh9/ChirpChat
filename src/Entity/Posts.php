<?php

namespace App\Entity;

use App\Repository\PostsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostsRepository::class)]
class Posts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $PostDetails = null;

    #[ORM\Column(length: 255)]
    private ?string $teamName = null;

    #[ORM\Column(length: 255)]
    private ?string $projectName = null;

    #[ORM\Column(length: 255)]
    private ?string $projectDocuments = null;

    #[ORM\ManyToOne(inversedBy: 'Posts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $details = null;

    #[ORM\OneToMany(mappedBy: 'commentsDetails', targetEntity: Comments::class)]
    private Collection $comments;

    #[ORM\Column(nullable: true)]
    private ?int $thumsUp = 0;

    #[ORM\Column(nullable: true)]
    private ?int $thumsDown = 0;

    #[ORM\OneToMany(mappedBy: 'postDel', targetEntity: LikeDislike::class)]
    private Collection $likeDetails;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->likeDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPostDetails(): ?string
    {
        return $this->PostDetails;
    }

    public function setPostDetails(string $PostDetails): self
    {
        $this->PostDetails = $PostDetails;

        return $this;
    }

    public function getProjectName(): ?string
    {
        return $this->projectName;
    }

    public function setProjectName(string $projectName): self
    {
        $this->projectName = $projectName;

        return $this;
    }

    public function getTeamName(): ?string
    {
        return $this->teamName;
    }

    public function setTeamName(string $teamName): self
    {
        $this->teamName = $teamName;

        return $this;
    }

    public function getProjectDocments(): ?string
    {
        return $this->projectDocuments;
    }

    public function setProjectDocuments(string $projectDocuments): self
    {
        $this->projectDocuments = $projectDocuments;

        return $this;
    }

    public function getDetails(): ?Login
    {
        return $this->details;
    }

    public function setDetails(?Login $details): self
    {
        $this->details = $details;

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setCommentsDetails($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCommentsDetails() === $this) {
                $comment->setCommentsDetails(null);
            }
        }

        return $this;
    }

    public function getThumsUp(): ?int
    {
        return $this->thumsUp;
    }

    public function setThumsUp(?int $thumsUp): self
    {
        $this->thumsUp = $thumsUp;

        return $this;
    }

    public function getThumsDown(): ?int
    {
        return $this->thumsDown;
    }

    public function setThumsDown(?int $thumsDown): self
    {
        $this->thumsDown = $thumsDown;

        return $this;
    }

    /**
     * @return Collection<int, LikeDislike>
     */
    public function getLikeDetails(): Collection
    {
        return $this->likeDetails;
    }

    public function addLikeDetail(LikeDislike $likeDetail): self
    {
        if (!$this->likeDetails->contains($likeDetail)) {
            $this->likeDetails->add($likeDetail);
            $likeDetail->setPostDel($this);
        }

        return $this;
    }

    public function removeLikeDetail(LikeDislike $likeDetail): self
    {
        if ($this->likeDetails->removeElement($likeDetail)) {
            // set the owning side to null (unless already changed)
            if ($likeDetail->getPostDel() === $this) {
                $likeDetail->setPostDel(null);
            }
        }

        return $this;
    }
}
