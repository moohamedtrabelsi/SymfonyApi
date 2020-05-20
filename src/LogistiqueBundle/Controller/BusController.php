<?php

namespace LogistiqueBundle\Controller;

use Knp\Component\Pager\Paginator;
use LogistiqueBundle\Entity\bus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * bus controller.
 *
 */
class BusController extends Controller
{
    /**
     * Lists all bus entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $buses = $em->getRepository('LogistiqueBundle:bus')->getbusbyNbrplace();
        /**
         * @var $paginator Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $buses,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',2)
        );
        return $this->render('bus/index.html.twig', array(
            'buses' => $result,
        ));
    }

    /**
     * Creates a new bus entity.
     *
     */
    public function newAction(Request $request)
    {
        $bus = new bus();
        $form = $this->createForm('LogistiqueBundle\Form\BusType', $bus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bus);
            $em->flush();

            return $this->redirectToRoute('bus_show', array('id' => $bus->getId()));
        }

        return $this->render('bus/new.html.twig', array(
            'bus' => $bus,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bus entity.
     *
     */
    public function showAction(bus $bus)
    {
        $deleteForm = $this->createDeleteForm($bus);

        return $this->render('bus/show.html.twig', array(
            'bus' => $bus,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bus entity.
     *
     */
    public function editAction(Request $request, bus $bus)
    {
        $deleteForm = $this->createDeleteForm($bus);
        $editForm = $this->createForm('LogistiqueBundle\Form\BusType', $bus);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bus_edit', array('id' => $bus->getId()));
        }

        return $this->render('bus/edit.html.twig', array(
            'bus' => $bus,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bus entity.
     *
     */
    public function deleteAction(Request $request, bus $bus)
    {
        $form = $this->createDeleteForm($bus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bus);
            $em->flush();
        }

        return $this->redirectToRoute('bus_index');
    }

    /**
     * Creates a form to delete a bus entity.
     *
     * @param bus $bus The bus entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(bus $bus)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bus_delete', array('id' => $bus->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
