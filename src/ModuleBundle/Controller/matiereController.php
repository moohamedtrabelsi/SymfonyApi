<?php

namespace ModuleBundle\Controller;

use ModuleBundle\Entity\matiere;
use ModuleBundle\Entity\module;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Matiere controller.
 *
 */
class matiereController extends Controller
{
    /**
     * Lists all matiere entities.
     *
     */
    public function indexAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

        $filter = $request->get('filter');

        if (!empty($filter)) {
            $dql = "select m from  ModuleBundle:matiere m where
                    m.name like :q or
                    m.coefficient like :q or
                    m.description like :q ";
            $query = $em->createQuery($dql)->setParameter("q",$filter)->getResult();
        }else{
            $dql = "SELECT c from  ModuleBundle:matiere c";
            $query = $em->createQuery($dql);
        }


        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('ModuleBundle:matiere:_matier_content.html.twig', [
                    'matieres' => $pagination
                ]),
            ]);
        }


        return $this->render('@Module/matiere/index.html.twig', array(
            'matieres' => $pagination,
        ));

    }


    public function index1Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $matiere = new matiere();
        $matieres = $em->getRepository('ModuleBundle:matiere')->findBy(array('module'=>$matiere->getModule()));

        return $this->render('@Module/matiere/index.html.twig', array(
            'matieres' => $matieres,
        ));
    }
    public function matmodAction(module $mod)
    {
        $matieres = $this->getDoctrine()->getManager()
            ->getRepository(matiere::class)->findBymod($mod);
        return ($this->render('@Module/module/matmod.html.twig', array("matieres" => $matieres,'module' => $mod,)));
    }

    public function indexEtudiantAction() {
        $em = $this->getDoctrine()->getManager();

        $matieres = $em->getRepository(matiere::class)->findAll();

        return $this->render('@Module/matiere/indexEtudiant.html.twig', array('matieres'=>$matieres,
        ));
    }


    /**
     * Creates a new matiere entity.
     *
     */
    public function newAction(Request $request)
    {
        $matiere = new Matiere();
        $form = $this->createForm('ModuleBundle\Form\matiereType', $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();

            return $this->redirectToRoute('matiere_show', array('id' => $matiere->getId()));
        }

        return $this->render('@Module/matiere/new.html.twig', array(
            'matiere' => $matiere,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a matiere entity.
     *
     */
    public function showAction(matiere $matiere)
    {
        $deleteForm = $this->createDeleteForm($matiere);

        return $this->render('@Module/matiere/show.html.twig', array(
            'matiere' => $matiere,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function rechercheByNameAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $matiere = $em->getRepository('ModuleBundle:matiere')->findAll();
        if ($request->isMethod("POST"))
        {
            $nom = $request->get('nom');
            $matiere =$em->getRepository("ModuleBundle:matiere")->findBy(array('nom'=>$nom));
        }

        return $this->render('@Module/matiere/recherche.html.twig', array(
            'matiere' => $matiere,
        ));
    }





    /**
     * Displays a form to edit an existing matiere entity.
     *
     */
    public function editAction(Request $request, matiere $matiere)
    {
        $deleteForm = $this->createDeleteForm($matiere);
        $editForm = $this->createForm('ModuleBundle\Form\matiereType', $matiere);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('matiere_edit', array('id' => $matiere->getId()));
        }

        return $this->render('@Module/matiere/edit.html.twig', array(
            'matiere' => $matiere,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a matiere entity.
     *
     */
    public function deleteAction(Request $request, matiere $matiere)
    {
        $form = $this->createDeleteForm($matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($matiere);
            $em->flush();
        }

        return $this->redirectToRoute('matiere_index');
    }

    /**
     * Creates a form to delete a matiere entity.
     *
     * @param matiere $matiere The matiere entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(matiere $matiere)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('matiere_delete', array('id' => $matiere->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
