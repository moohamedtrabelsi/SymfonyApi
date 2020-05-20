<?php

namespace JsonBundle\Controller;


use LibBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
//use JMS\Serializer\Serializer;
use Symfony\Component\Serializer\Serializer;

//use Zend\Diactoros\Request\Serializer;

//use Zend\Diactoros\Response\Serializer;


class CategorieController extends Controller
{
   /* public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = new Categorie();
        $categorie->setNom($request->get('name'));

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($categorie);
        return new JsonResponse($formatted);
       /* $form = $this->createForm('LibBundle\Form\CategorieType', $categorie);
        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('categorie_show', array('id' => $categorie->getId()));
        }*/

    public function indexbackAction()
    {
        $em = $this->getDoctrine()->getManager();

        $livres = $em->getRepository('LibBundle:Livre')->findAll();
       $categories = $em->getRepository('LibBundle:Categorie')->findAll();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($categories);
        return new JsonResponse($formatted );
      //return $categories;
    }

}
