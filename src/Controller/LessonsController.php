<?php

namespace App\Controller;

use App\Entity\Lessons;
use App\Form\LessonsType;
use App\Repository\LessonsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/lessons')]
class LessonsController extends AbstractController
{
    #[Route('/', name: 'app_lessons_index', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(LessonsRepository $lessonsRepository): Response
    {
        return $this->render('lessons/index.html.twig', [
            'lessons' => $lessonsRepository->findAll(),
            'title' => 'List of lessons'
        ]);
    }

    #[Route('/new/course/{id}', name: 'app_lessons_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_INSTRUCTOR')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lesson = new Lessons();
        $form = $this->createForm(LessonsType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lesson->setCourseId($request->get('id'));
            $entityManager->persist($lesson);
            $entityManager->flush();

            return $this->redirectToRoute('app_lessons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lessons/new.html.twig', [
            'lesson' => $lesson,
            'form' => $form,
            'title' => 'Create a lesson'
        ]);
    }

    #[Route('/{id}', name: 'app_lessons_show', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function show(Lessons $lesson): Response
    {
        return $this->render('lessons/show.html.twig', [
            'lesson' => $lesson,
            'title' => 'Information about lesson ' . $lesson->getId()
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lessons_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_INSTRUCTOR')]
    public function edit(Request $request, Lessons $lesson, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LessonsType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lessons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('lessons/edit.html.twig', [
            'lesson' => $lesson,
            'form' => $form,
            'title' => 'Edit lesson ' . $lesson->getId()
        ]);
    }

    #[Route('/{id}', name: 'app_lessons_delete', methods: ['POST'])]
    #[IsGranted('ROLE_INSTRUCTOR')]
    public function delete(Request $request, Lessons $lesson, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lesson->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lesson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lessons_index', [], Response::HTTP_SEE_OTHER);
    }
}
