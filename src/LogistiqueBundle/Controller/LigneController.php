<?php

namespace LogistiqueBundle\Controller;

use LogistiqueBundle\Entity\ligne;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use Symfony\Component\HttpFoundation\Request;

/**
 * ligne controller.
 *
 */
class LigneController extends Controller
{
    /**
     * Lists all ligne entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $lignes = $em->getRepository('LogistiqueBundle:ligne')->findAll();

        return $this->render('ligne/index.html.twig', array(
            'lignes' => $lignes,
        ));
    }

    public function mailAction($name, Swift_Mailer $mailer)
    {
        $ligne = new ligne();
        $form = $this->createForm('LogistiqueBundle\Form\LigneType', $ligne);
        $message = (new \Swift_Message('New Ligne'))
            ->setFrom('send@example.com')
            ->setTo('bechir.chourabi@esprit.tn')
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'Emails/registration.html.twig',
                    ['name' => $name]
                ),
                'text/html'
            )

            // you can remove the following code if you don't define a text version for your emails
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    ['name' => $name]
                ),
                'text/plain'
            )
        ;

        $mailer->send($message);

        // or, you can also fetch the mailer service this way
        // $this->get('mailer')->send($message);


        return $this->render('ligne/new.html.twig', array(
            'ligne' => $ligne,
            'form' => $form->createView(),
        ));
    }




    /**
     * Creates a new ligne entity.
     *
     */
    public function newAction(Request $request)
    {
        $ligne = new ligne();
        $form = $this->createForm('LogistiqueBundle\Form\LigneType', $ligne);
        $form->handleRequest($request);
$user=$this->container->get('security.token_storage')->getToken()->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ligne);
            $em->flush();

            return $this->redirectToRoute('ligne_show', array('id' => $ligne->getId()));
        }

        return $this->render('ligne/new.html.twig', array(
            'ligne' => $ligne,
            'form' => $form->createView(),
            'user'=>$user,

        ));
    }

    /**
     * Finds and displays a ligne entity.
     *
     */
    public function showAction(ligne $ligne)
    {
        $deleteForm = $this->createDeleteForm($ligne);

        return $this->render('ligne/show.html.twig', array(
            'ligne' => $ligne,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ligne entity.
     *
     */
    public function editAction(Request $request, ligne $ligne)
    {
        $deleteForm = $this->createDeleteForm($ligne);
        $editForm = $this->createForm('LogistiqueBundle\Form\LigneType', $ligne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ligne_edit', array('id' => $ligne->getId()));
        }

        return $this->render('ligne/edit.html.twig', array(
            'ligne' => $ligne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ligne entity.
     *
     */
    public function deleteAction(Request $request, ligne $ligne)
    {
        $form = $this->createDeleteForm($ligne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ligne);
            $em->flush();
        }

        return $this->redirectToRoute('ligne_index');
    }

    /**
     * Creates a form to delete a ligne entity.
     *
     * @param ligne $ligne The ligne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ligne $ligne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ligne_delete', array('id' => $ligne->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
