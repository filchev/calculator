<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class BaseTaxType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('amount', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                    "label" => "app_common.amount",
                    'translation_domain' => 'translations',
                ])
                ->add('baseTaxProperties', CollectionType::class, array(
                    'entry_type' => TaxBaseTaxType::class,
                    'label' => false,
                    'allow_add' => true,
                    'options' => ['label' => false]
                ))
                ->add('submit', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class, array('label' => 'Запиши'))
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event)
        {

       //     $form = $event->getData();
//           dump($form); die();
        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\BaseTax'
        ));
    }

}
