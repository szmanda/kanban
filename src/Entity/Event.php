<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column]
    private ?float $duration = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MainTask $mainTask = null;

    #[ORM\OneToOne(mappedBy: 'event', cascade: ['persist', 'remove'])]
    private ?Task $task = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(float $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getMainTask(): ?MainTask
    {
        return $this->mainTask;
    }

    public function setMainTask(?MainTask $mainTask): self
    {
        $this->mainTask = $mainTask;

        return $this;
    }

    public function getTask(): ?Task
    {
        return $this->task;
    }

    public function setTask(?Task $task): self
    {
        // unset the owning side of the relation if necessary
        if ($task === null && $this->task !== null) {
            $this->task->setEvent(null);
        }

        // set the owning side of the relation if necessary
        if ($task !== null && $task->getEvent() !== $this) {
            $task->setEvent($this);
        }

        $this->task = $task;

        return $this;
    }
}
