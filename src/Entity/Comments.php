<?php

namespace App\Entity;

use App\Repository\CommentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentsRepository::class)]
class Comments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $comments = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Posts $commentsDetails = null;

    #[ORM\ManyToOne(inversedBy: 'LoginComments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $LoginComments = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getCommentsDetails(): ?Posts
    {
        return $this->commentsDetails;
    }

    public function setCommentsDetails(?Posts $commentsDetails): self
    {
        $this->commentsDetails = $commentsDetails;

        return $this;
    }

    public function getLoginComments(): ?Login
    {
        return $this->LoginComments;
    }

    public function setLoginComments(?Login $LoginComments): self
    {
        $this->LoginComments = $LoginComments;

        return $this;
    }
}
