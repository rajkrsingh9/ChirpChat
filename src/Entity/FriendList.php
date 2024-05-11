<?php

namespace App\Entity;

use App\Repository\FriendListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendListRepository::class)]
class FriendList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'User')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $User = null;

    #[ORM\ManyToOne(inversedBy: 'Friends')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Login $Friends = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Login
    {
        return $this->User;
    }

    public function setUser(?Login $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getFriends(): ?Login
    {
        return $this->Friends;
    }

    public function setFriends(?Login $Friends): self
    {
        $this->Friends = $Friends;

        return $this;
    }
}
