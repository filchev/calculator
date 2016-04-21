<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Tax;
use AppBundle\Form\TaxType;

/**
 * Tax controller.
 *
 */
class TaxController extends Controller
{

    /**
     * Creates a form to delete a Tax entity.
     *
     * @param Tax $tax The Tax entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tax $tax)
    {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('dashboard_taxes_delete', array('id' => $tax->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /**
     * 
     * @param type $tax
     * @param type $newTax
     * @return type
     */
    private function cloneTaxProperties($tax, $newTax)
    {
        $newTax->setTranslations($tax->getTranslations());
        $newTax->setValueFrom($tax->getValueFrom());
        $newTax->setValueTo($tax->getValueTo());
        return $newTax;
    }
//
//    private function addTranslations(){
//        
//    }
    /**
     * Lists all Tax entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $taxes = $em->getRepository('AppBundle:Tax')->findAll();

        return $this->render('AppBundle:Tax:index.html.twig', array(
                    'taxes' => $taxes,
        ));
    }

    /**
     * Creates a new Tax entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $tax = new Tax;
        $prefix = $em->getRepository(\AppBundle\Entity\Language::class)->findOneBy(['prefix' => 'bg']);
        $tax->addTranslation(array(
            'translation' => '',
            'prefix' => $prefix
        ));
        $form = $this->createForm('AppBundle\Form\TaxType', $tax);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $taxFactory = new \AppBundle\Factory\TaxFactory();
            $newTax = $this->cloneTaxProperties($tax, $taxFactory->createNewTax($tax->getCategory()));
            $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');

            foreach ($newTax->getTranslations() as $translation) {
                $repository->translate($newTax, 'name', $translation['prefix']->getPrefix(), $translation['translation']);
                if ($translation['prefix']->getPrefix() == 'bg') {
                    $newTax->setName($translation['translation']);
                }
            }
            $em->persist($newTax);
            $em->flush();

            return $this->redirectToRoute('dashboard_taxes_show', array('id' => $newTax->getId()));
        }

        return $this->render('AppBundle:Tax:new.html.twig', array(
                    'tax' => $tax,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tax entity.
     *
     */
    public function showAction(Tax $tax)
    {
        $deleteForm = $this->createDeleteForm($tax);

        return $this->render('AppBundle:Tax:show.html.twig', array(
                    'tax' => $tax,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Tax entity.
     *
     */
    public function editAction(Request $request, Tax $tax)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('Gedmo\\Translatable\\Entity\\Translation');
        $translations = $repository->findBy(array('foreignKey' => $tax->getId()));
        foreach ($translations as $translation) {
            $prefix = $em->getRepository(\AppBundle\Entity\Language::class)->findOneBy(['prefix' => $translation->getLocale()]);
            $tax->addTranslation(array(
                'translation' => $translation->getContent(),
                'prefix' => $prefix
            ));
        }
        $editForm = $this->createForm('AppBundle\Form\TaxType', $tax);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            foreach ($tax->getTranslations() as $translation) {
                $repository->translate($tax, 'name', $translation['prefix']->getPrefix(), $translation['translation']);
            }
            $em->persist($tax);
            $em->flush();
            return $this->redirectToRoute('dashboard_taxes_edit', array('id' => $tax->getId()));
        }

        return $this->render('AppBundle:Tax:edit.html.twig', array(
                    'tax' => $tax,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Tax entity.
     *
     */
    public function deleteAction(Request $request, Tax $tax)
    {
        $form = $this->createDeleteForm($tax);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tax);
            $em->flush();
        }
        return $this->redirectToRoute('dashboard_taxes_index');
    }

}
