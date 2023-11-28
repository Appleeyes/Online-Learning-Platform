<?php

namespace App\DataFixtures;

use App\Entity\Courses;
use App\Entity\Enrollments;
use App\Entity\Lessons;
use App\Entity\Profile;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixture extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 21; $i < 40; $i++) {
            $user = $this->createUser($i);
            $this->loadUserData($manager, $user, $i);
        }
    }

    private function createUser(int $i): Users
    {
        $user = new Users();
        $user->setUsername('user' . $i);
        $user->setEmail('user' . $i . '@gmail.com');
        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                '123456'
            )
        );
        $user->setRoles($i % 2 == 0 ? ['ROLE_INSTRUCTOR'] : ['ROLE_STUDENTS']);

        return $user;
    }

    private function loadUserData(ObjectManager $manager, Users $user, int $i): void
    {
        $manager->persist($user);
        $manager->flush();

        $this->loadProfile($manager, $user, $i);

        if ($i % 2 == 0) {
            $this->loadCourses($manager, $user, $i);
        }
    }

    private function loadProfile(ObjectManager $manager, Users $user, int $i): void
    {
        $profile = new Profile();
        $profile->setUser($user);
        $profile->setCountry('USA');
        $profile->setAddress('Test address ' . $i);

        $manager->persist($profile);
        $manager->flush();
    }

    private function loadCourses(ObjectManager $manager, Users $user, int $i): void
    {
        $courses = new Courses();
        $courses->setInstructor($user);
        $courses->setTitle('Course title ' . $i);
        $courses->setDescription('Course description ' . $i);
        $courses->setHours($i);
        $courses->setMinutes($i);

        $manager->persist($courses);
        $manager->flush();

        for ($j = 0; $j < 3; $j++) {
            $this->loadLesson($manager, $courses, $j);
        }

        $enrollment = new Enrollments();
        $enrollment->setCourse($courses);
        $enrollment->setUser($user);

        $manager->persist($enrollment);
        $manager->flush();
    }

    private function loadLesson(ObjectManager $manager, Courses $courses, int $j): void
    {
        $lesson = new Lessons();
        $lesson->setCourse($courses);
        $lesson->setTitle('Lesson title ' . $j);
        $lesson->setContent('Lesson content ' . $j);

        $manager->persist($lesson);
        $manager->flush();
    }
}
