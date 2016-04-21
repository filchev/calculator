<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\BaseTax;
use AppBundle\Form\BaseTaxType;

/**
 * BaseTax controller.
 *
 */
class BaseTaxController extends Controller
{
    /**
     * Lists all BaseTax entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $baseTaxes = $em->getRepository('AppBundle:BaseTax')->findAll();

        return $this->render('basetax/index.html.twig', array(
            'baseTaxes' => $baseTaxes,
        ));
    }

    /**
     * Creates a new BaseTax entity.
     *
     */
    public function newAction(Request $request)
    {
        $baseTax = new BaseTax();
        $form = $this->createForm('AppBundle\Form\BaseTaxType', $baseTax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($baseTax);
            $em->flush();

            return $this->redirectToRoute('basetax_show', array('id' => $baseTax->getId()));
        }

        return $this->render('basetax/new.html.twig', array(
            'baseTax' => $baseTax,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BaseTax entity.
     *
     */
    public function showAction(BaseTax $baseTax)
    {
        $deleteForm = $this->createDeleteForm($baseTax);

        return $this->render('basetax/show.html.twig', array(
            'baseTax' => $baseTax,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BaseTax entity.
     *
     */
    public function editAction(Request $request, BaseTax $baseTax)
    {
        $deleteForm = $this->createDeleteForm($baseTax);
        $editForm = $this->createForm('AppBundle\Form\BaseTaxType', $baseTax);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($baseTax);
            $em->flush();

            return $this->redirectToRoute('basetax_edit', array('id' => $baseTax->getId()));
        }

        return $this->render('basetax/edit.html.twig', array(
            'baseTax' => $baseTax,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BaseTax entity.
     *
     */
    public function deleteAction(Request $request, BaseTax $baseTax)
    {
        $form = $this->createDeleteForm($baseTax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($baseTax);
            $em->flush();
        }

        return $this->redirectToRoute('basetax_index');
    }

    /**
     * Creates a form to delete a BaseTax entity.
     *
     * @param BaseTax $baseTax The BaseTax entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BaseTax $baseTax)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('basetax_delete', array('id' => $baseTax->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
