<?php

namespace App\Controller;

use App\Entity\Courses;
use App\Entity\Lessons;
use App\Entity\Users;
use App\Form\InstructorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class InstructorController extends AbstractController
{
    #[Route('/instructor', name: 'app_instructor')]
    public function index(): Response
    {
        /** @var Users $user */
        $user = $this->getUser();
        $courses = $user->getCourses();
        return $this->render('instructor/index.html.twig', [
            'user' => $user,
            'courses' => $courses,
        ]);
    }

    #[Route('/apply/instructor', name: 'app_instructor_apply')]
    public function applyInstructor(EntityManagerInterface $entityManager): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw new AccessDeniedException('This action requires authentication.');
        }

        /** @var Users $user */
        $user = $this->getUser();

        // Update user roles and is_instructor field
        $user->setRoles(['ROLE_INSTRUCTOR']);
        $user->setIsInstructor(true);

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Your instructor application has been submitted.');

        return $this->redirectToRoute('app_instructor');
    }

    #[Route('/course/{id}', name: 'app_instructor_course_show')]
    public function showCourse(Courses $course): Response
    {
        return $this->render('instructor/courseShow.html.twig', [
            'course' => $course,
        ]);
    }

    #[Route('/{id}/lesson', name: 'app_instructor_course_lessons')]
    public function showCourseLessons(Lessons $lesson): Response
    {
        return $this->render('instructor/lesson.html.twig', [
            'lesson' => $lesson,
            'title' => 'Information about lesson ' . $lesson->getId()
        ]);
    }
}
