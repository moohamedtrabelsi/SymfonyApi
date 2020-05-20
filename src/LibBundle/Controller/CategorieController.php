<?php

namespace LibBundle\Controller;

use LibBundle\Entity\Categorie;
use LibBundle\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categorie controller.
 *
 */
class CategorieController extends Controller
{
    /**
     * Lists all categorie entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $filter = $request->get('filter');

        if (!empty($filter)) {
            $dql = "select p from  LibBundle:Categorie p where
                    p.nom like :q ";
            $query = $em->createQuery($dql)->setParameter("q",$filter)->getResult();
        }else{
            $dql = "SELECT p from LibBundle:Categorie p";
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
                'content' => $this->renderView('categorie/_categories_content.html.twig', [
                    'categories' => $pagination
                ]),
            ]);
        }


        return ($this->render('categorie/index.html.twig',array (
            "categories"=>$pagination,

        )));
    }

    public function indexbackAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('LibBundle:Categorie')->findAll();

        return $this->render('categorie/indexback.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new categorie entity.
     *
     */
    public function newAction(Request $request)
    {
        $categorie = new Categorie();
        $form = $this->createForm('LibBundle\Form\CategorieType', $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('categorie_show', array('id' => $categorie->getId()));
        }

        return $this->render('categorie/new.html.twig', array(
            'categorie' => $categorie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categorie entity.
     *
     */
    public function showAction(Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($categorie);
        $editForm = $this->createForm('LibBundle\Form\CategorieType', $categorie);
        $livres = $this->getDoctrine()->getManager()
            ->getRepository(Livre::class)->findBycat($categorie);

        $categories = $em->getRepository('LibBundle:Categorie')->findAll();
        return $this->render('categorie/show.html.twig', array(
            "livres" => $livres,
            'categorie' => $categorie,
            'delete_form' => $deleteForm->createView(),
            'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categorie entity.
     *
     */
    public function editAction(Request $request, Categorie $categorie)
    {
        $deleteForm = $this->createDeleteForm($categorie);
        $editForm = $this->createForm('LibBundle\Form\CategorieType', $categorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_edit', array('id' => $categorie->getId()));
        }

        return $this->render('categorie/edit.html.twig', array(
            'categorie' => $categorie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categorie entity.
     *
     */
    public function deleteAction(Request $request, Categorie $categorie)
    {
        $form = $this->createDeleteForm($categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorie);
            $em->flush();
        }

        return $this->redirectToRoute('categorie_index');
    }

    /**
     * Creates a form to delete a categorie entity.
     *
     * @param Categorie $categorie The categorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categorie $categorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categorie_delete', array('id' => $categorie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function triAction()
    {
        $categories = $this->getDoctrine()->getManager()
            ->getRepository(Categorie::class)->findalltri();
        return $this->render('categorie/index.html.twig', array(
            'categories' => $categories,
        ));
    }


    public function catAction(Request $request)
    {
        $em =  $this->getDoctrine()->getManager();

        $filter = $request->get('filter');

         if (!empty($filter)) {
            $dql = "select p from  LibBundle:Categorie p where
                    p.nom like :q ";
            $query = $em->createQuery($dql)->setParameter("q",$filter)->getResult();
        }else{
            $dql = "SELECT p from LibBundle:Categorie p";
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
                'content' => $this->renderView('categorie/_categories_content.html.twig', [
                    'categories' => $pagination
                 ]),
            ]);
        }


        return ($this->render('categorie/index.html.twig',array (
             "categories"=>$pagination,

        )));}

}
