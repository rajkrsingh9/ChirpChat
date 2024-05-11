<?php

namespace App\Entity;

use App\Repository\LikeDislikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeDislikeRepository::class)]
class LikeDislike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $thUp = null;

    #[ORM\Column(length: 255)]
    private ?string $thDown = null;

    #[ORM\ManyToOne(inversedBy: 'likeDetails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Posts $postDel = null;

    #[ORM\ManyToOne(inversedBy: 'userLike')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $likeDislike = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThUp(): ?string
    {
        return $this->thUp;
    }

    public function setThUp(string $thUp): self
    {
        $this->thUp = $thUp;

        return $this;
    }

    public function getThDown(): ?string
    {
        return $this->thDown;
    }

    public function setThDown(string $thDown): self
    {
        $this->thDown = $thDown;

        return $this;
    }

    public function getPostDel(): ?Posts
    {
        return $this->postDel;
    }

    public function setPostDel(?Posts $postDel): self
    {
        $this->postDel = $postDel;

        return $this;
    }

    public function getLikeDislike(): ?Login
    {
        return $this->likeDislike;
    }

    public function setLikeDislike(?Login $likeDislike): self
    {
        $this->likeDislike = $likeDislike;

        return $this;
    }
}
