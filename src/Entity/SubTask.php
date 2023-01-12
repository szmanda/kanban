<?php

namespace App\Entity;

use App\Repository\SubTaskRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubTaskRepository::class)]
class SubTask
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\ManyToOne(inversedBy: 'subTasks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MainTask $mainTask = null;

    #[ORM\OneToOne(mappedBy: 'subTask', cascade: ['persist', 'remove'])]
    private ?Task $task = null;

    public function getId(): ?int
    {
        return $this->id;
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
            $this->task->setSubTask(null);
        }

        // set the owning side of the relation if necessary
        if ($task !== null && $task->getSubTask() !== $this) {
            $task->setSubTask($this);
        }

        $this->task = $task;

        return $this;
    }
}
