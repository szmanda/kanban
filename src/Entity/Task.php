<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'tasks')]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'task', targetEntity: WorkTime::class)]
    private Collection $workTimes;

    #[ORM\OneToOne(inversedBy: 'task', cascade: ['persist', 'remove'])]
    private ?MainTask $mainTask = null;

    #[ORM\OneToOne(inversedBy: 'task', cascade: ['persist', 'remove'])]
    private ?SubTask $subTask = null;

    #[ORM\OneToOne(inversedBy: 'task', cascade: ['persist', 'remove'])]
    private ?Event $event = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->workTimes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * @return Collection<int, WorkTime>
     */
    public function getWorkTimes(): Collection
    {
        return $this->workTimes;
    }

    public function addWorkTime(WorkTime $workTime): self
    {
        if (!$this->workTimes->contains($workTime)) {
            $this->workTimes->add($workTime);
            $workTime->setTask($this);
        }

        return $this;
    }

    public function removeWorkTime(WorkTime $workTime): self
    {
        if ($this->workTimes->removeElement($workTime)) {
            // set the owning side to null (unless already changed)
            if ($workTime->getTask() === $this) {
                $workTime->setTask(null);
            }
        }

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

    public function getSubTask(): ?SubTask
    {
        return $this->subTask;
    }

    public function setSubTask(?SubTask $subTask): self
    {
        $this->subTask = $subTask;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }
}
