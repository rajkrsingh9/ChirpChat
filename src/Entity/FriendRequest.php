<?php

namespace App\Entity;

use App\Repository\FriendRequestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendRequestRepository::class)]
class FriendRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $requestStatus = null;

    #[ORM\ManyToOne(inversedBy: 'request')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $fromRequest = null;

    #[ORM\ManyToOne(inversedBy: 'requestTo')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $toRequest = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRequestStatus(): ?int
    {
        return $this->requestStatus;
    }

    public function setRequestStatus(int $requestStatus): self
    {
        $this->requestStatus = $requestStatus;

        return $this;
    }

    public function getFromRequest(): ?Login
    {
        return $this->fromRequest;
    }

    public function setFromRequest(?Login $fromRequest): self
    {
        $this->fromRequest = $fromRequest;

        return $this;
    }

    public function getToRequest(): ?Login
    {
        return $this->toRequest;
    }

    public function setToRequest(?Login $toRequest): self
    {
        $this->toRequest = $toRequest;

        return $this;
    }
}