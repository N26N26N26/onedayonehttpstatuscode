<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryRepository::class)]
class History
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $totalanswer;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $totalgoodanswer;

    #[ORM\ManyToOne(targetEntity: Status::class, inversedBy: 'histories')]
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTotalanswer(): ?int
    {
        return $this->totalanswer;
    }

    public function setTotalanswer(int $totalanswer): self
    {
        $this->totalanswer = $totalanswer;

        return $this;
    }

    public function getTotalgoodanswer(): ?int
    {
        return $this->totalgoodanswer;
    }

    public function setTotalgoodanswer(?int $totalgoodanswer): self
    {
        $this->totalgoodanswer = $totalgoodanswer;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }
}
