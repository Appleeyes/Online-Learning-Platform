<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentController extends AbstractController
{
    #[Route('/student/courses', name: 'app_student_courses')]
    public function enrolledCourses(): Response
    {
        /** @var Users $user */
        $user = $this->getUser();

        $enrolledCourses = [];
        foreach ($user->getEnrollments() as $enrollment) {
            $enrolledCourses[] = $enrollment->getCourse();
        }

        return $this->render('student/index.html.twig', [
            'enrolledCourses' => $enrolledCourses,
            'user' => $user,
        ]);
    }
}
