<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaxType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//                ->add('name')
                ->add('valueFrom', null, [
                    'required' => false
                ])
                ->add('valueTo', null, [
                    'required' => false
                ])
                ->add('category', null, [
                    'placeholder' => '',
                    'required' => true
                ])
                ->add('translations', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, array(
                    'entry_type' => LanguageType::class,
                    'label' => ' ',
//                    'mapped' => false,
                    'allow_add' => true,
                    'options' => ['label' => false],
//                    'data' => array()
                ))
                ->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array('label' => 'Запиши'))

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Tax'
//            'data_class' => null
        ));
    }

}
