<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/users/')]
class UserController extends AbstractController
{
    #[Route('{username}', name: 'user_summary', requirements: ['username' => '\w+'])]
    public function summary(string $username, UserRepository $repository): Response
    {
        $user = $repository->findOneBy(['username' => $username]);

        if (null === $user) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }

        return $this->json([
            'fullName' => $user->getFullName(),
        ]);
    }
}
