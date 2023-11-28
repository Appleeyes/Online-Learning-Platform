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

;

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
            $user = new Users();
            $user->setUsername('user' . $i);
            $user->setEmail('user' . $i . '@gmail.com');
            $user->setPassword(
                $this->hasher->hashPassword(
                    $user,
                    '123456'
                )
            );
            if ($i % 2 == 0) {
                $user->setRoles(['ROLE_INSTRUCTOR']);
            } else {
                $user->setRoles(['ROLE_STUDENTS']);
            }
            $manager->persist($user);
            $manager->flush();

            $profile = new Profile();
            $profile->setUser($user);
            $profile->setCountry('USA');
            $profile->setAddress('Test address ' . $i);
            $manager->persist($profile);
            $manager->flush();

            if ($i % 2 == 0) {
                $courses = new Courses();
                $courses->setInstructor($user);
                $courses->setTitle('Course title ' . $i);
                $courses->setDescription('Course description ' . $i);
                $courses->setHours($i);
                $courses->setMinutes($i);
                $manager->persist($courses);
                $manager->flush();

                for ($j = 0; $j < 3; $j++) {
                    $lesson = new Lessons();
                    $lesson->setCourse($courses);
                    $lesson->setTitle('Lesson title ' . $j);
                    $lesson->setContent('Lesson content ' . $j);
                    $manager->persist($lesson);
                    $manager->flush();
                }

                $enrollment = new Enrollments();
                $enrollment->setCourse($courses);
                $enrollment->setUser($user);
                $manager->persist($enrollment);
                $manager->flush();
            }
        }
    }
}
