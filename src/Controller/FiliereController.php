<?php

namespace App\Controller;

use App\Entity\Filiere;
use App\Form\FiliereType;
use App\Repository\FiliereRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FiliereController extends AbstractController
{
    #[Route('/filiere/add', name: 'add_filiere',methods:['GET', 'POST'])]
    public function add(EntityManagerInterface $manager,Request $request): Response
    {
        $filiere=new Filiere();
        $form=$this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $filiere=$form->getData();
            $manager->persist($filiere);
            $manager->flush();
            $this->addFlash('success', 'La filière a été ajoutée avec succès !');
        
            // Redirection vers la liste des filières
            return $this->redirectToRoute('list_filiere');
        }
        return $this->render('filiere/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/filiere/list', name: 'list_filiere',methods:['GET'])]
    public function list(FiliereRepository $filiereRepository,Request $request): Response
    {
        $filieres=$filiereRepository->findAll();
        
        return $this->render('filiere/list.html.twig', [
            'filieres' => $filieres,
        ]);
    }
}
