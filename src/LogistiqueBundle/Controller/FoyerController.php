<?php

namespace LogistiqueBundle\Controller;

use LogistiqueBundle\Entity\foyer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Foyer controller.
 *
 *
 */
class FoyerController extends Controller
{
    /**
     * Lists all foyer entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $foyers = $em->getRepository('LogistiqueBundle:foyer')->findAll();

        return $this->render('foyer/index.html.twig', array(
            'foyers' => $foyers,
        ));
    }

    /**
     * Creates a new foyer entity.
     *
     */
    public function newAction(Request $request)
    {
        $foyer = new foyer();
        $form = $this->createForm('LogistiqueBundle\Form\FoyerType', $foyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($foyer);
            $em->flush();

            return $this->redirectToRoute('foyer_show', array('id' => $foyer->getId()));
        }

        return $this->render('foyer/new.html.twig', array(
            'foyer' => $foyer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a foyer entity.
     *
     */
    public function showAction(Foyer $foyer)
    {
        $deleteForm = $this->createDeleteForm($foyer);

        return $this->render('foyer/show.html.twig', array(
            'foyer' => $foyer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing foyer entity.
     *
     */
    public function editAction(Request $request, foyer $foyer)
    {
        $deleteForm = $this->createDeleteForm($foyer);
        $editForm = $this->createForm('LogistiqueBundle\Form\FoyerType', $foyer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('foyer_edit', array('id' => $foyer->getId()));
        }

        return $this->render('foyer/edit.html.twig', array(
            'foyer' => $foyer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a foyer entity.
     *
     */
    public function deleteAction(Request $request, foyer $foyer)
    {
        $form = $this->createDeleteForm($foyer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($foyer);
            $em->flush();
        }

        return $this->redirectToRoute('foyer_index');
    }

    /**
     * Creates a form to delete a foyer entity.
     *
     * @param Foyer $foyer The foyer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(foyer $foyer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('foyer_delete', array('id' => $foyer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
