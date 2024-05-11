<?php

namespace App\Entity;

use App\Repository\OTPRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OTPRepository::class)]
class OTP
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $emailId = null;

    #[ORM\Column]
    private ?int $Otp = null;

    #[ORM\Column]
    private ?int $validity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailId(): ?string
    {
        return $this->emailId;
    }

    public function setEmailId(string $emailId): self
    {
        $this->emailId = $emailId;

        return $this;
    }

    public function getOtp(): ?int
    {
        return $this->Otp;
    }

    public function setOtp(int $Otp): self
    {
        $this->Otp = $Otp;

        return $this;
    }

    public function getValidity(): ?int
    {
        return $this->validity;
    }

    public function setValidity(int $validity): self
    {
        $this->validity = $validity;

        return $this;
    }
}
