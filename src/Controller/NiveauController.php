<?php

namespace App\Controller;

use App\Entity\Niveau;
use App\Form\NiveauType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class NiveauController extends AbstractController
{
    #[Route('/niveau/add', name: 'add_niveau')]
    public function index(EntityManagerInterface $manager,Request $request): Response
    {
        $niveau=new Niveau();
        $form=$this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $niveau=$form->getData();
           $manager->persist($niveau);
           $manager->flush();
        }
        return $this->render('niveau/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
