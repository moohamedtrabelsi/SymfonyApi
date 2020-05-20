<?php

namespace ClassesBundle\Controller;

use ClassesBundle\Entity\Branche;
use ClassesBundle\Form\BrancheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BrancheController extends Controller
{
    public function readAction()
    {
        $em=$this->getDoctrine();
        $liste=$em->getRepository(Branche::class)->findAll();
        return $this->render('@Classes/Branche/read.html.twig',array(
            "liste"=>$liste
        ));

    }
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $branche=$em->getRepository(Branche::class)->find($id);
        $em->remove($branche);
        $em->flush();
        return $this->redirectToRoute('branche_read');

    }

    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $branche=$em->getRepository(Branche::class)->find($id);
        $form=$this->createForm(BrancheType::class,$branche);
        $form=$form->handleRequest($request);
        if($form->isValid())
        {

            //persister les donnees dans ORM
            $em->persist($branche);
            //sauvegarder les donnees dans BD
            $em->flush();
            return $this->redirectToRoute('branche_read');
        }



        return $this->render('@Classes/Branche/update.html.twig',array(
            'form'=>$form->createView()
        ));




    }
    public function createAction(Request $request)
    {
        //creer un objet vide
        $branche= new Branche();
        // creer notre formulaire
        $form=$this->createForm(BrancheType::class,$branche);
        //recuperation de donnes
        $form=$form->handleRequest($request);
        //test sur les donnees
        if($form->isValid())
        {
            //creation d un objet doctrine
            $em=$this->getDoctrine()->getManager();
            //persister les donnees dans ORM
            $em->persist($branche);
            //sauvegarder les donnees dans BD
            $em->flush();
            return $this->redirectToRoute('branche_read');
        }
        // envoyer ce formulaire à l utilisateur
        return $this->render('@Classes/Branche/create.html.twig',array(
            'form'=>$form->createView()
        ));

    }
}
