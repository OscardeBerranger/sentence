<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }


    #[Route('/admin/promote/{id}', name: 'app_user_promote', methods: ['GET'])]
    #[Route('/admin/demote/{id}', name: 'app_user_demote', methods: ['GET'])]
    public function granter(Request $request, User $user, UserRepository $repository){
        $grant = true;
        if ($request->get('_route')==="app_user_promote"){
            $user->setRoles(["ROLE_ADMIN"]);
        }else{
            $user->setRoles([]);
        }
        $repository->save($user, true);
        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

}
