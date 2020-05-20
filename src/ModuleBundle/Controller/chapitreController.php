<?php

namespace ModuleBundle\Controller;

use ModuleBundle\Entity\chapitre;
use ModuleBundle\Entity\matiere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Chapitre controller.
 *
 */
class chapitreController extends Controller
{
    /**
     * Lists all chapitre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $chapitres = $em->getRepository('ModuleBundle:chapitre')->findAll();

        return $this->render('@Module/chapitre/index.html.twig', array(
            'chapitres' => $chapitres,
        ));
    }

    public function indexEtudAction() {
        $em = $this->getDoctrine()->getManager();

        $chapitres = $em->getRepository(chapitre::class)->findAll();

        return $this->render('@Module/chapitre/indexEtud.html.twig', array(
            'chapitres' => $chapitres,
        ));
    }


    public function chapmatAction(matiere $mat)
    {
        $chapitres = $this->getDoctrine()->getManager()
            ->getRepository(chapitre::class)->findBymat($mat);
        return ($this->render('@Module/matiere/chapmat.html.twig', array("chapitres" => $chapitres,'matiere' => $mat,)));
    }





    /**
     * Creates a new chapitre entity.
     *
     */
    public function newAction(Request $request)
    {
        $chapitre = new Chapitre();
        $form = $this->createForm('ModuleBundle\Form\chapitreType', $chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($chapitre);
            $em->flush();

            return $this->redirectToRoute('chapitre_show', array('id' => $chapitre->getId()));
        }

        return $this->render('@Module/chapitre/new.html.twig', array(
            'chapitre' => $chapitre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a chapitre entity.
     *
     */
    public function showAction(chapitre $chapitre)
    {
        $deleteForm = $this->createDeleteForm($chapitre);

        return $this->render('@Module/chapitre/show.html.twig', array(
            'chapitre' => $chapitre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing chapitre entity.
     *
     */
    public function editAction(Request $request, chapitre $chapitre)
    {
        $deleteForm = $this->createDeleteForm($chapitre);
        $editForm = $this->createForm('ModuleBundle\Form\chapitreType', $chapitre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chapitre_edit', array('id' => $chapitre->getId()));
        }

        return $this->render('@Module/chapitre/edit.html.twig', array(
            'chapitre' => $chapitre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a chapitre entity.
     *
     */
    public function deleteAction(Request $request, chapitre $chapitre)
    {
        $form = $this->createDeleteForm($chapitre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($chapitre);
            $em->flush();
        }

        return $this->redirectToRoute('chapitre_index');
    }

    /**
     * Creates a form to delete a chapitre entity.
     *
     * @param chapitre $chapitre The chapitre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(chapitre $chapitre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('chapitre_delete', array('id' => $chapitre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
