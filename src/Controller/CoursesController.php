<?php

namespace App\Controller;

use App\Entity\Courses;
use App\Entity\Enrollments;
use App\Entity\Users;
use App\Form\CoursesType;
use App\Repository\CoursesRepository;
use App\Repository\EnrollmentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/courses')]
#[IsGranted('ROLE_INSTRUCTOR')]
class CoursesController extends AbstractController
{
    #[Route('/', name: 'app_courses_index', methods: ['GET'])]
    public function index(CoursesRepository $coursesRepository): Response
    {
        $currentUser = $this->getUser();
        return $this->render('courses/index.html.twig', [
            'courses' => $coursesRepository->findAll(),
            'user' => $currentUser,
            'title' => 'List of courses'
        ]);
    }

    #[Route('/new', name: 'app_courses_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $course = new Courses();
        $form = $this->createForm(CoursesType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($course);
            $entityManager->flush();

            return $this->redirectToRoute('app_courses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('courses/new.html.twig', [
            'course' => $course,
            'form' => $form,
            'title' => 'Create a course'
        ]);
    }

    #[Route('/{id}', name: 'app_courses_show', methods: ['GET'])]
    public function show(Request $request, Courses $course): Response
    {
        return $this->render('courses/show.html.twig', [
            'course' => $course,
            'title' => 'Information about Courses ' . $course->getTitle()
        ]);
    }

    #[Route('/{id}/edit', name: 'app_courses_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Courses $course, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CoursesType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_courses_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('courses/edit.html.twig', [
            'course' => $course,
            'form' => $form,
            'title' => 'Edit course ' . $course->getId()
        ]);
    }

    #[Route('/{id}/enroll', name: 'app_courses_enroll', methods: ['GET'])]
    public function enroll(Request $request, Courses $course, EntityManagerInterface $entityManager): Response
    {
        $enrollment = new Enrollments();
        $enrollment->setCourse($course);
        $enrollment->setUser($this->getUser());
        $entityManager->persist($enrollment);
        $entityManager->flush();
        return $this->redirectToRoute('app_courses_show', ['id' => $request->get('id')]);
    }

    #[Route('/{id}/unenroll', name: 'app_courses_unenroll', methods: ['GET'])]
    public function unenroll(Request $request, Courses $course, EntityManagerInterface $entityManager, EnrollmentsRepository $enrollmentsRepository): Response
    {
        $enrollment = $enrollmentsRepository->findOneBy(['course' => $course, 'user' => $this->getUser()]);
        $entityManager->remove($enrollment);
        $entityManager->flush();
        return $this->redirectToRoute('app_courses_index', ['id' => $request->get('id')]);
    }

    #[Route('/{id}', name: 'app_courses_delete', methods: ['POST'])]
    public function delete(Request $request, Courses $course, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$course->getId(), $request->request->get('_token'))) {
            $entityManager->remove($course);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_courses_index', [], Response::HTTP_SEE_OTHER);
    }
}
