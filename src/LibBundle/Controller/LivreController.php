<?php

namespace LibBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use LibBundle\Entity\Livre;
use LibBundle\Entity\Categorie;
use LibBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Livre controller.
 *
 */
class LivreController extends Controller
{
    /**
     * Lists all livre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $livres = $em->getRepository('LibBundle:Livre')->findAll();

        return $this->render('livre/index.html.twig', array(
            'livres' => $livres,
        ));
    }

    public function indexetudAction()
    {
        $em = $this->getDoctrine()->getManager();

        $livres = $em->getRepository('LibBundle:Livre')->finddis();

        return $this->render('livre/indexetud.html.twig', array(
            'livres' => $livres,
        ));
    }

    /**
     * Creates a new livre entity.
     *
     */
    public function newAction(Request $request)
    {
        $livre = new Livre();
        $form = $this->createForm('LibBundle\Form\LivreType', $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livre);
            $em->flush();

            return $this->redirectToRoute('livre_show', array('id' => $livre->getId()));
        }

        return $this->render('livre/new.html.twig', array(
            'livre' => $livre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a livre entity.
     *
     * @Route("/{id}", name="livre_show")
     * @Method("GET")
     */
    public function showAction(Request $request,Livre $livre)
    {   $livre->setNbv($livre->getNbv()+1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();


        $editForm = $this->createForm('LibBundle\Form\LivreType', $livre);
        return $this->render('livre/show.html.twig', array(
            'livre' => $livre,
            'edit_form' => $editForm->createView()



        ));

    }

    public function reserverAction(Request $request,Livre $livre)
    {   $livre->setDisponible('false');
        $res = new Reservation($livre);
        $user=$this->container->get('security.token_storage')->getToken()->getUser();


      $res->setUser($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($res);
        $em->flush();
        return $this->render('reservation/show.html.twig', array(
            'livre' => $livre,
            'reservation'=>$res,

        ));
    }

    public function incnbjAction(Request $request,Livre $livre)
    {$livre->setNbj($livre->getNbj()+1);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $livre->setRating($livre->getNbj()/$livre->getNbv());
        $em->flush();
        return $this->render('livre/show.html.twig', array(
            'livre' => $livre,


        ));
    }
    public function livreparcatAction(Categorie $cat)
    {
        $livres = $this->getDoctrine()->getManager()
            ->getRepository(Livre::class)->findBycat($cat);
        return ($this->render('Categorie/show.html.twig', array("livres" => $livres,'categorie' => $cat,)));
    }

    /**
     * Displays a form to edit an existing livre entity.
     *
     */
    public function editAction(Request $request, Livre $livre)
    {
        $deleteForm = $this->createDeleteForm($livre);
        $editForm = $this->createForm('LibBundle\Form\LivreType', $livre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livre_edit', array('id' => $livre->getId()));
        }

        return $this->render('livre/edit.html.twig', array(
            'livre' => $livre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a livre entity.
     *
     */
    public function deleteAction(Request $request, Livre $livre)
    {
        $form = $this->createDeleteForm($livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($livre);
            $em->flush();
        }

        return $this->redirectToRoute('livre_index');
    }

    /**
     * Creates a form to delete a livre entity.
     *
     * @param Livre $livre The livre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Livre $livre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('livre_delete', array('id' => $livre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
