<?php

namespace ClassesBundle\Controller;

use AppBundle\Entity\User;
use ClassesBundle\Entity\Classe;
use ClassesBundle\Form\ClasseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

class ClasseController extends Controller
{
    public function RechercheAction(Request $request)
    {
        $em=$this->getDoctrine();
        $liste=$em->getRepository(Classe::class)->searchC($request->get('search'));


        return $this->render('@Classes/Classe/recheche.html.twig',array(
            "liste"=>$liste
        ));

    }


    public function createAction(Request $request)
    {
        //creer un objet vide
        $classe= new Classe();
        $classe->setNbrEtudiants(0);
        // creer notre formulaire
        $form=$this->createForm(ClasseType::class,$classe);
        //recuperation de donnes
        $form=$form->handleRequest($request);
        //test sur les donnees
        if($form->isValid())
        {
            //creation d un objet doctrine
            $em=$this->getDoctrine()->getManager();
            //persister les donnees dans ORM

            $em->persist($classe);
            //sauvegarder les donnees dans BD
            $em->flush();
            return $this->redirectToRoute('classe_read');
        }
        // envoyer ce formulaire à l utilisateur
        return $this->render('@Classes/Classe/create.html.twig',array(
            'form'=>$form->createView()
        ));
    }

    public function readAction(Request $request)
    {
        $em=$this->getDoctrine();
        $liste=$em->getRepository(Classe::class)->findAll();
        /**
         * @var $pagination \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $result=$paginator->paginate($liste,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',1));


        $nbrTotal=0;
        foreach ($liste as $row)
        {
            $nbrTotal+=$row->getNbrEtudiants();

        }

        $data= array();
        $stat=['Classe','Etudiants'];
        $nb=0;
        array_push($data,$stat);
        foreach ($liste as $row)
        {
            $stat=array();
//            array_push($stat,$row->getPartenaire()->getNom(),(($row->getMontant())*100)/$montantTotal);
//            $nb=($row->getMontant()*100)/$montantTotal;

            array_push($stat,$row->getNom(),$row->getNbrEtudiants());

            $nb=$row->getNbrEtudiants();

            $stat=[$row->getNom(),$nb];
            array_push($data,$stat);
        }

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable($data);
        $pieChart->getOptions()->setTitle("Nombre d'étudiants par classe : ");
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(1125);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#f47684');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('@Classes/Classe/read.html.twig',array(
            "liste"=>$result,"piechart"=>$pieChart
        ));

    }
    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $classe=$em->getRepository(Classe::class)->find($id);
        $etudiants=$em->getRepository(Classe::class)->searchEtudiants($id);
        foreach ($etudiants as $row)
        {
            $row->setClasse(null);
        }
        foreach ($etudiants as $row)
        {
           $em->persist($row);
        }
        $em->remove($classe);
        $em->flush();
        return $this->redirectToRoute('classe_read');

    }
    public function updateAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $classe=$em->getRepository(Classe::class)->find($id);
        $form=$this->createForm(ClasseType::class,$classe);
        $form=$form->handleRequest($request);
        if($form->isValid())
        {

            //persister les donnees dans ORM
            $em->persist($classe);
            //sauvegarder les donnees dans BD
            $em->flush();
            return $this->redirectToRoute('classe_read');
        }



        return $this->render('@Classes/Classe/update.html.twig',array(
            'form'=>$form->createView()
        ));




    }

    public function EtudiantsAction($id)
    {
        $em=$this->getDoctrine();
        $classe=$em->getRepository(Classe::class)->find($id);
        $liste=$em->getRepository(Classe::class)->searchEtudiants($id);
        return $this->render('@Classes/Classe/viewEtudiants.html.twig',array(
            "liste"=>$liste,"classe"=>$classe
        ));
    }


}
