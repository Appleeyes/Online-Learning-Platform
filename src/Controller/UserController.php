<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('user/index.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/users/all', name: 'app_all_users')]
    public function users(UsersRepository $usersRepisotory): Response
    {
        $users = $usersRepisotory->findAll();
        return $this->render('user/all_users.html.twig', [
            'users' => $users
        ]);
    }
}
