<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{

    #[Route('/users/all', name: 'app_all_users')]
    public function users(UsersRepository $usersRepisotory): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $users = $usersRepisotory->findAll();
        return $this->render('user/all_users.html.twig', [
            'users' => $users
        ]);
    }
}
