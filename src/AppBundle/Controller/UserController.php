<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use ClassesBundle\Entity\Classe;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function readEtudiantsAction()
    {
        $em=$this->getDoctrine();
        $liste=$em->getRepository(User::class)->findEtudiants();

        return $this->render('@App/User/readEtudiants.html.twig',array(
            "liste"=>$liste
        ));

    }
    public function AffecterEtudiantAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $etudiant=$em->getRepository(User::class)->find($id);
        $form=$this->createForm(RegistrationFormType::class,$etudiant);
        $table=$em->getRepository(Classe::class)->findAll();
        $form=$form->handleRequest($request);
        if($form->isValid())
        {
           if($etudiant->getClasse()!=null)
           {
           $cl=$em->getRepository(Classe::class)->find($etudiant->getClasse()->getId());
            $cl->setNbrEtudiants($cl->getNbrEtudiants()-1);
            $em->persist($cl);
           }

            $id=$request->get('classe');
            $classe=$em->getRepository(Classe::class)->find($id);
            $classe->setNbrEtudiants($classe->getNbrEtudiants()+1);
            $etudiant->setClasse($classe);

            $em->persist($etudiant);
            $em->flush();

            $basic  = new \Nexmo\Client\Credentials\Basic('2a815647', 'AFM0bqq8YawybYOD');
            $client =new \Nexmo\Client($basic);


            //Uncomment to send sms

            $message = $client->message()->send([
                'to' => '21693051543',
                'from' => 'Ecole',
                'text' => 'Vous etes affecté a votre classe'
            ]);



            return $this->redirectToRoute('read_etudiants');
        }




        return $this->render('@App/User/affecterEtudiant.html.twig',array(
            "form"=>$form->createView(),"etudiant"=>$etudiant,"table"=>$table
        ));

    }

}
