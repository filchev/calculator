<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\InsurancePolicy;
use AppBundle\Form\InsurancePolicyType;

/**
 * InsurancePolicy controller.
 *
 */
class InsurancePolicyController extends Controller
{
    /**
     * Lists all InsurancePolicy entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $insurancePolicies = $em->getRepository('AppBundle:InsurancePolicy')->findAll();

        return $this->render('insurancepolicy/index.html.twig', array(
            'insurancePolicies' => $insurancePolicies,
        ));
    }

    /**
     * Creates a new InsurancePolicy entity.
     *
     */
    public function newAction(Request $request)
    {
        $insurancePolicy = new InsurancePolicy();
        $form = $this->createForm('AppBundle\Form\InsurancePolicyType', $insurancePolicy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($insurancePolicy);
            $em->flush();

            return $this->redirectToRoute('insurancepolicy_show', array('id' => $insurancePolicy->getId()));
        }

        return $this->render('insurancepolicy/new.html.twig', array(
            'policyDetails' => $insurancePolicy,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a InsurancePolicy entity.
     *
     */
    public function showAction(InsurancePolicy $insurancePolicy)
    {

        $insurancePolicy->getTaxes()->getValues();
        $insurancePolicy->getBaseTax()->getAmount();
        return $this->render('insurancepolicy/show.html.twig', array(
            'insurancePolicy' => $insurancePolicy,
        ));
    }

    /**
     * Displays a form to edit an existing InsurancePolicy entity.
     *
     */
    public function editAction(Request $request, InsurancePolicy $insurancePolicy)
    {
        $deleteForm = $this->createDeleteForm($insurancePolicy);
        $editForm = $this->createForm('AppBundle\Form\InsurancePolicyType', $insurancePolicy);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($insurancePolicy);
            $em->flush();

            return $this->redirectToRoute('insurancepolicy_edit', array('id' => $insurancePolicy->getId()));
        }

        return $this->render('insurancepolicy/edit.html.twig', array(
            'insurancePolicy' => $insurancePolicy,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a InsurancePolicy entity.
     *
     */
    public function deleteAction(Request $request, InsurancePolicy $insurancePolicy)
    {
        $form = $this->createDeleteForm($insurancePolicy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($insurancePolicy);
            $em->flush();
        }

        return $this->redirectToRoute('insurancepolicy_index');
    }

    /**
     * Creates a form to delete a InsurancePolicy entity.
     *
     * @param InsurancePolicy $insurancePolicy The InsurancePolicy entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(InsurancePolicy $insurancePolicy)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('insurancepolicy_delete', array('id' => $insurancePolicy->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
