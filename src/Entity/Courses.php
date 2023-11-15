<?php

namespace App\Entity;

use App\Repository\CoursesRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursesRepository::class)]
class Courses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: "instructor_id")]
    private ?int $instructorId = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(name: "created_at")]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(name: "updated_at")]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'courses')]
    private ?Users $instructors = null;

    #[ORM\OneToMany(mappedBy: 'courses', targetEntity: Lessons::class)]
    private Collection $lessons;

    #[ORM\OneToMany(mappedBy: 'courses', targetEntity: Enrollments::class)]
    private Collection $enrollments;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->lessons = new ArrayCollection();
        $this->enrollments = new ArrayCollection();
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

    public function getInstructorId(): ?int
    {
        return $this->instructorId;
    }

    public function setInstructorId(int $instructorId): static
    {
        $this->instructorId = $instructorId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getInstructors(): ?Users
    {
        return $this->instructors;
    }

    public function setInstructors(?Users $instructors): static
    {
        $this->instructors = $instructors;

        return $this;
    }

    /**
     * @return Collection<int, Lessons>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lessons $lesson): static
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons->add($lesson);
            $lesson->setCourses($this);
        }

        return $this;
    }

    public function removeLesson(Lessons $lesson): static
    {
        if ($this->lessons->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getCourses() === $this) {
                $lesson->setCourses(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Enrollments>
     */
    public function getEnrollments(): Collection
    {
        return $this->enrollments;
    }

    public function addEnrollment(Enrollments $enrollment): static
    {
        if (!$this->enrollments->contains($enrollment)) {
            $this->enrollments->add($enrollment);
            $enrollment->setCourses($this);
        }

        return $this;
    }

    public function removeEnrollment(Enrollments $enrollment): static
    {
        if ($this->enrollments->removeElement($enrollment)) {
            // set the owning side to null (unless already changed)
            if ($enrollment->getCourses() === $this) {
                $enrollment->setCourses(null);
            }
        }

        return $this;
    }
}
