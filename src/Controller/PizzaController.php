<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pizza;
use Doctrine\ORM\EntityManagerInterface;

class PizzaController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/pizza', name: 'pizza')]
    public function pizza(): Response
    {
        $pizzas = $this->entityManager->getRepository(Pizza::class)->findAll();

        return $this->render('pizza/index.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }
}