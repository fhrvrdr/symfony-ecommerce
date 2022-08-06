<?php

namespace App\Controller\Client;

use App\Repository\Customer\UserAdressRepository;
use Doctrine\Persistence\ManagerRegistry;
use LDAP\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $entityManager;
    private $userAdressRepository;
    public function __construct(ManagerRegistry $entityManager, UserAdressRepository $userAdressRepository)
    {
        $this->entityManager = $entityManager;
        $this->userAdressRepository = $userAdressRepository;
    }


    #[Route('/user/profile/adress', name: 'user_adress', methods: 'GET')]
    public function index(): Response
    {
        return new Response('Deneme');
    }
}
