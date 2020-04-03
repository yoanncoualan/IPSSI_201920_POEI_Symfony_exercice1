<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Utilisateur ajouté');
        }

        $utilisateurs = $em->getRepository(Utilisateur::class)->findAll();

        return $this->render('utilisateur/index.html.twig', [
            'utilisateurs' => $utilisateurs,
            'ajout' => $form->createView()
        ]);
    }

    /**
     * @Route("/utilisateur/{id}", name="utilisateur_edit")
     */
    public function edit(Utilisateur $utilisateur = null, Request $request){

        if($utilisateur == null){
            $this->addFlash('error', 'Utilisateur existant');
            return $this->redirectToRoute('home');
        }

        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($utilisateur);
            $em->flush();

            $this->addFlash('success', 'Utilisateur modifié');
        }

        return $this->render('utilisateur/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'edit' => $form->createView()
        ]);

    }
}
