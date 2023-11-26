<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminController extends AbstractController
{
    #[Route('/apply/admin', name: 'app_admin_apply')]
    public function applyInstructor(EntityManagerInterface $entityManager): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw new AccessDeniedException('This action requires authentication.');
        }

        /** @var Users $user */
        $user = $this->getUser();

        // Update user roles field
        $user->setRoles(['ROLE_ADMIN']);

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Your admin application has been submitted.');

        return $this->redirectToRoute('admin');
    }
}
