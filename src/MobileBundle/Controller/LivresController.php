<?php

namespace MobileBundle\Controller;

use LibBundle\Entity\Categorie;
use LibBundle\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class LivresController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $livres = $em->getRepository('LibBundle:Livre')->findAll();
        $serializer = new Serializer([new DateTimeNormalizer(),new ObjectNormalizer()]);
        $formatted = $serializer->normalize($livres);
        return new JsonResponse($formatted);

    }

    public function livreparcatAction(int $cat)
    {
        $livres = $this->getDoctrine()->getManager()
            ->getRepository(Livre::class)->findallBycat($cat);
        $serializer = new Serializer([new DateTimeNormalizer(),new ObjectNormalizer()]);
        $formatted = $serializer->normalize($livres);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request)
    {  $livre = new Livre();

        $em = $this->getDoctrine()->getManager();

        $livre->setRating($request->get('rating'));
        $livre->setDisponible($request->get('disponible'));
        $livre->setNbj($request->get('nbj'));
        $livre->setNbv($request->get('nbv'));
        $livre->setTitre($request->get('titre'));
        $em->persist($livre);
        $em->flush();
        $serializer = new Serializer([new DateTimeNormalizer(),new ObjectNormalizer()]);
        $formatted = $serializer->normalize($livre);
        return new JsonResponse($formatted);
    }

}
