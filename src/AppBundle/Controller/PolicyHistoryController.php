<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\PolicyHistory;
use AppBundle\Form\PolicyHistoryType;

/**
 * PolicyHistory controller.
 *
 */
class PolicyHistoryController extends Controller
{
    /**
     * Lists all PolicyHistory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $policyHistories = $em->getRepository('AppBundle:PolicyHistory')->findAll();

        return $this->render('policyhistory/index.html.twig', array(
            'policyHistories' => $policyHistories,
        ));
    }

    /**
     * Creates a new PolicyHistory entity.
     *
     */
    public function newAction(Request $request)
    {
        $policyHistory = new PolicyHistory();
        $form = $this->createForm('AppBundle\Form\PolicyHistoryType', $policyHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($policyHistory);
            $em->flush();

            return $this->redirectToRoute('policyhistory_show', array('id' => $policyHistory->getId()));
        }

        return $this->render('policyhistory/new.html.twig', array(
            'policyHistory' => $policyHistory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PolicyHistory entity.
     *
     */
    public function showAction(PolicyHistory $policyHistory)
    {
        $deleteForm = $this->createDeleteForm($policyHistory);

        return $this->render('policyhistory/show.html.twig', array(
            'policyHistory' => $policyHistory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PolicyHistory entity.
     *
     */
    public function editAction(Request $request, PolicyHistory $policyHistory)
    {
        $deleteForm = $this->createDeleteForm($policyHistory);
        $editForm = $this->createForm('AppBundle\Form\PolicyHistoryType', $policyHistory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($policyHistory);
            $em->flush();

            return $this->redirectToRoute('policyhistory_edit', array('id' => $policyHistory->getId()));
        }

        return $this->render('policyhistory/edit.html.twig', array(
            'policyHistory' => $policyHistory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PolicyHistory entity.
     *
     */
    public function deleteAction(Request $request, PolicyHistory $policyHistory)
    {
        $form = $this->createDeleteForm($policyHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($policyHistory);
            $em->flush();
        }

        return $this->redirectToRoute('policyhistory_index');
    }

    /**
     * Creates a form to delete a PolicyHistory entity.
     *
     * @param PolicyHistory $policyHistory The PolicyHistory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PolicyHistory $policyHistory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('policyhistory_delete', array('id' => $policyHistory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
