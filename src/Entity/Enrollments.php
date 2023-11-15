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

    #[ORM\Column(name: "student_id")]
    private ?int $studentId = null;

    #[ORM\Column(name: "course_id")]
    private ?int $courseId = null;

    #[ORM\Column(name: "enrollment_date")]
    private ?\DateTimeImmutable $enrollmentDate = null;

    #[ORM\ManyToOne(inversedBy: 'enrollments')]
    private ?Users $users = null;

    #[ORM\ManyToOne(inversedBy: 'enrollments')]
    private ?Courses $courses = null;

    #[ORM\OneToMany(mappedBy: 'enrollments', targetEntity: Progress::class)]
    private Collection $progresses;

    public function __construct()
    {
        $this->progresses = new ArrayCollection();
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

    public function getStudentId(): ?int
    {
        return $this->studentId;
    }

    public function setStudentId(int $studentId): static
    {
        $this->studentId = $studentId;

        return $this;
    }

    public function getCourseId(): ?int
    {
        return $this->courseId;
    }

    public function setCourseId(int $courseId): static
    {
        $this->courseId = $courseId;

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

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getCourses(): ?Courses
    {
        return $this->courses;
    }

    public function setCourses(?Courses $courses): static
    {
        $this->courses = $courses;

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
            $progresses->setEnrollments($this);
        }

        return $this;
    }

    public function removeProgress(Progress $progresses): static
    {
        if ($this->progresses->removeElement($progresses)) {
            // set the owning side to null (unless already changed)
            if ($progresses->getEnrollments() === $this) {
                $progresses->setEnrollments(null);
            }
        }

        return $this;
    }
}
