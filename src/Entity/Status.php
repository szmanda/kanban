<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'statuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Board $board = null;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: MainTask::class, orphanRemoval: true)]
    private Collection $mainTasks;

    public function __construct()
    {
        $this->mainTasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getBoard(): ?Board
    {
        return $this->board;
    }

    public function setBoard(?Board $board): self
    {
        $this->board = $board;

        return $this;
    }

    /**
     * @return Collection<int, MainTask>
     */
    public function getMainTasks(): Collection
    {
        return $this->mainTasks;
    }

    public function addMainTask(MainTask $mainTask): self
    {
        if (!$this->mainTasks->contains($mainTask)) {
            $this->mainTasks->add($mainTask);
            $mainTask->setStatus($this);
        }

        return $this;
    }

    public function removeMainTask(MainTask $mainTask): self
    {
        if ($this->mainTasks->removeElement($mainTask)) {
            // set the owning side to null (unless already changed)
            if ($mainTask->getStatus() === $this) {
                $mainTask->setStatus(null);
            }
        }

        return $this;
    }
}
