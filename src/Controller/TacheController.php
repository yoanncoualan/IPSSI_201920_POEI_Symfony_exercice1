<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TacheController extends AbstractController
{
    /**
     * @Route("/tache", name="tache")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tache = new Tache();
        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($tache);
            $em->flush();

            $this->addFlash('success', 'Tache ajoutée');
        }

        $taches = $em->getRepository(Tache::class)->findAll();

        return $this->render('tache/index.html.twig', [
            'taches' => $taches,
            'ajout' => $form->createView()
        ]);
    }

    /**
     * @Route("/tache/etat/{id}", name="change_etat")
     */
    public function changeEtat(Tache $tache = null){
        if($tache == null){
            $this->addFlash('error', 'Tâche introuvable');
            return $this->redirectToRoute('tache');
        }

        if($tache->getEtat() == 1){
            $tache->setEtat(0);
        }
        else{
            $tache->setEtat(1);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($tache);
        $em->flush();

        $this->addFlash('success', 'Tâche mise à jour');
        return $this->redirectToRoute('tache');
    }

    /**
     * @Route("/tache/delete/{id}", name="delete_tache")
     */
    public function delete(Tache $tache = null){
        if($tache == null){
            $this->addFlash('error', 'Tâche introuvable');
            return $this->redirectToRoute('tache');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($tache);
        $em->flush();

        $this->addFlash('success', 'Tâche supprimée');
        return $this->redirectToRoute('tache');
    }

    /**
     * @Route("/tache/edit/{id}", name="edit_tache")
     */
    public function edit(Tache $tache = null, Request $request){
        if($tache == null){
            $this->addFlash('error', 'Tâche introuvable');
            return $this->redirectToRoute('tache');
        }

        $form = $this->createForm(TacheType::class, $tache);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($tache);
            $em->flush();

            $this->addFlash('success', 'Tâche mise à jour');
        }    
        
        return $this->render('tache/edit.html.twig', [
            'tache' => $tache,
            'edit' => $form->createView()
        ]);
    }
}
