<?php

namespace ModuleBundle\Controller;

use ModuleBundle\Entity\matiere;
use ModuleBundle\Entity\module;
use ModuleBundle\Form\matiereType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Module controller.
 *
 */
class moduleController extends Controller
{
    /**
     * Lists all module entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $modules = $em->getRepository('ModuleBundle:module')->findAll();

        return $this->render('@Module/module/index.html.twig', array(
            'modules' => $modules,
        ));
    }

    public function indexEnseignantAction() {
        $em = $this->getDoctrine()->getManager();

        $modules = $em->getRepository('ModuleBundle:module')->findAll();

        return $this->render('@Module/module/indexEnseignant.html.twig', array(
            'modules' => $modules,
        ));
    }

    /**
     * Creates a new module entity.
     *
     */
    public function newAction(Request $request)
    {
        $module = new module();
        $form = $this->createForm('ModuleBundle\Form\moduleType', $module);

        $form->handleRequest($request);
        $mat=new matiere();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($module);
            $em->flush();

            return $this->redirectToRoute('module_show', array('id' => $module->getId()));
        }

        return $this->render('@Module/module/new.html.twig', array(
            'module' => $module,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a module entity.
     *
     */
    public function showAction(module $module)
    {
        $deleteForm = $this->createDeleteForm($module);

        return $this->render('@Module/module/show.html.twig', array(
            'module' => $module,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing module entity.
     *
     */
    public function editAction(Request $request, module $module)
    {
        $deleteForm = $this->createDeleteForm($module);
        $editForm = $this->createForm('ModuleBundle\Form\moduleType', $module);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('module_edit', array('id' => $module->getId()));
        }

        return $this->render('@Module/module/edit.html.twig', array(
            'module' => $module,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a module entity.
     *
     */
    public function deleteAction(Request $request, module $module)
    {
        $form = $this->createDeleteForm($module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($module);
            $em->flush();
        }

        return $this->redirectToRoute('module_delete');
    }

    /**
     * Creates a form to delete a module entity.
     *
     * @param module $module The module entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(module $module)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('module_delete', array('id' => $module->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
