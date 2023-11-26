<?php

namespace App\Entity;

use App\Repository\EnrollmentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnrollmentsRepository::class)]
class Enrollments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "enrollment_date")]
    private ?\DateTimeImmutable $enrollmentDate = null;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'enrollments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user = null;

    #[ORM\ManyToOne(targetEntity: Courses::class, inversedBy: 'enrollments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Courses $course = null;

    #[ORM\OneToMany(mappedBy: 'enrollment', targetEntity: Progress::class, cascade: ['remove'])]
    private Collection $progresses;

    public function __construct()
    {
        $this->progresses = new ArrayCollection();
        $this->enrollmentDate = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getEnrollmentDate(): ?\DateTimeImmutable
    {
        return $this->enrollmentDate;
    }

    public function setEnrollmentDate(\DateTimeImmutable $enrollmentDate): static
    {
        $this->enrollmentDate = $enrollmentDate;

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCourse(): ?Courses
    {
        return $this->course;
    }

    public function setCourse(?Courses $course): static
    {
        $this->course = $course;

        return $this;
    }

    /**
     * @return Collection<int, Progress>
     */
    public function getProgresses(): Collection
    {
        return $this->progresses;
    }

    public function addProgresses(Progress $progresses): static
    {
        if (!$this->progresses->contains($progresses)) {
            $this->progresses->add($progresses);
            $progresses->setEnrollment($this);
        }

        return $this;
    }

    public function removeProgress(Progress $progresses): static
    {
        if ($this->progresses->removeElement($progresses)) {
            // set the owning side to null (unless already changed)
            if ($progresses->getEnrollment() === $this) {
                $progresses->setEnrollment(null);
            }
        }

        return $this;
    }
}
