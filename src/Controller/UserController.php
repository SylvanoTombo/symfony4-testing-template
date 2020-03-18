<?php

namespace App\Controller;

use App\Document\User;
use App\Entity\CartHistory;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @var DocumentManager
     */
    private $documentManager;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UserController constructor.
     * @param DocumentManager $documentManager
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(DocumentManager $documentManager, EntityManagerInterface $entityManager)
    {
        $this->documentManager = $documentManager;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/users", name="user")
     */
    public function index()
    {
        $users = $this->documentManager->getRepository(User::class)->findAll();

//        $user = new User();
//        $user->setName('Mark');
//
//        $this->documentManager->persist($user);
//        $this->documentManager->flush();
//
//        $cartHistory = new CartHistory();
//        $cartHistory->addUser($user);
//
//
//        $this->entityManager->persist($cartHistory);
//        $this->entityManager->flush();

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users' => $users
        ]);
    }

    /**
     * @Route("/users/{id}", name="users.show")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $userRepository = $this->documentManager->getRepository(User::class);

        $user = $userRepository->find($id);

        return $this->render('user/show.html.twig', compact('user'));
    }
}
