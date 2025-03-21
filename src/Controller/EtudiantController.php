<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EtudiantController extends AbstractController
{
    #[Route('/etudiant/add', name: 'add_etudiant',methods:['GET', 'POST'])]
    public function add(EntityManagerInterface $manager,Request $request,EtudiantRepository $etudiantRepository): Response
    {
    
        $etudiant=new Etudiant();
        $form=$this->createForm(EtudiantType::class,$etudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            $etudiant=$form->getData();
            $etudiant->setRoles('ROLE_ETUDIANT');
            $etudiant->setMatricule(substr($etudiant->getTuteur(),0,1)."00".$etudiantRepository->count($etudiantRepository->findAll())+1+substr($etudiant->getTuteur(),-2));
            $manager->persist($etudiant);
            $manager->flush();
        }

        return $this->render('etudiant/index.html.twig', [
            
            'form' => $form->createView(),
        ]);
    }
}
