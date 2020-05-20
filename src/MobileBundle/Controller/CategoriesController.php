<?php

namespace MobileBundle\Controller;

use LibBundle\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CategoriesController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('LibBundle:Categorie')->findAll();
        $serializer = new Serializer([new DateTimeNormalizer(),new ObjectNormalizer()]);
        $formatted = $serializer->normalize($categories);
        return new JsonResponse($formatted);

    }
    public function newAction(Request $request)
    {  $categorie = new Categorie();

        $em = $this->getDoctrine()->getManager();

      $categorie->setDescription($request->get('description'));
      $categorie->setNom($request->get('nom'));
      $categorie->setRating($request->get('rating'));

        $em->persist($categorie);
        $em->flush();
        $serializer = new Serializer([new DateTimeNormalizer(),new ObjectNormalizer()]);
        $formatted = $serializer->normalize($categorie);
        return new JsonResponse($formatted);
    }



}
