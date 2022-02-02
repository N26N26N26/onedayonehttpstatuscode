<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $nickname;

    #[ORM\Column(type: 'integer')]
    private $totalAnswers;

    #[ORM\Column(type: 'integer')]
    private $goodanswers;

    #[ORM\Column(type: 'integer')]
    private $inarow;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getTotalAnswers(): ?int
    {
        return $this->totalAnswers;
    }

    public function setTotalAnswers(int $totalAnswers): self
    {
        $this->totalAnswers = $totalAnswers;

        return $this;
    }

    public function getGoodanswers(): ?int
    {
        return $this->goodanswers;
    }

    public function setGoodanswers(int $goodanswers): self
    {
        $this->goodanswers = $goodanswers;

        return $this;
    }

    public function getInarow(): ?int
    {
        return $this->inarow;
    }

    public function setInarow(int $inarow): self
    {
        $this->inarow = $inarow;

        return $this;
    }
}
