<?php

namespace JsonBundle\Controller;

use LibBundle\Entity\Categorie;
use LibBundle\Entity\Livre;
use LibBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class LivreController extends Controller
{
    public function indexbackAction(Categorie $cat)
    {
        $em = $this->getDoctrine()->getManager();

        $livres = $this->getDoctrine()->getManager()
            ->getRepository(Livre::class)->findBycat($cat);
        $categories = $em->getRepository('LibBundle:Categorie')->findAll();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($livres);
        return new JsonResponse($formatted );
        //return $categories;
    }

    public function incnbjAction(Request $request,Livre $livre)
    {$livre->setNbj($livre->getNbj()+1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $livre->setRating($livre->getNbj()/$livre->getNbv());
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($livre);
        return new JsonResponse($formatted );
    }

    public function reserverAction(Request $request,Livre $livre,User $user)
    {   $livre->setDisponible('false');
        $res = new Reservation($livre);
       // $user=$this->container->get('security.token_storage')->getToken()->getUser();


        $res->setUser($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($res);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($res);
        return new JsonResponse($formatted );
    }



}
