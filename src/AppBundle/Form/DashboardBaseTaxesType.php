<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SearchFormType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->setMethod('GET')
                ->add('driver_age', TextType::class, array(
                    'label' => 'Възраст на собственика',
                    "label" => "app_search_engine.order",
                    'translation_domain' => 'translations',
                ))
                ->add('vehicle_type', EntityType::class, [
                    'label' => 'МПС се използва основно за',
                    'class' => 'AppBundle\Entity\VehicleUsedFor',
//                    'choice_label' => 'getLabelFromTo',
                ])
                ->add('driver_age', EntityType::class, [
                    'label' => 'Възраст на водача',
                    'class' => 'AppBundle\Entity\Driver',
                    'choice_label' => 'getLabelFromTo',
                ])
                ->add('engine_capacity', EntityType::class, [
                    'label' => 'Кубатура на двигателя',
                    'class' => 'AppBundle\Entity\EngineCapacity',
                    'choice_label' => 'getLabelFromTo',
                ])
                ->add('region', EntityType::class, [
                    'label' => 'Регистрация на МПС',
                    'class' => 'AppBundle\Entity\Region',
                ])
                ->add('damageInsurance', EntityType::class, [
                    'empty_data' => null,
                    'placeholder' => "",
                    'label' => 'Каско',
                    'required' => false,
                    'class' => 'AppBundle\Entity\DamageInsurance',
                ])
                ->add('wheelDirection', EntityType::class, [
                    'empty_data' => null,
                    'placeholder' => "Ляв Волан",
                    'label' => 'Посока на волана',
                    'class' => 'AppBundle\Entity\WheelDirection',
                ])
                ->add('others', EntityType::class, [
                    'label' => 'Други',
                    'multiple' => true,
                    'expanded' => true,
                    'class' => 'AppBundle\Entity\OtherTax',
                ])
                ->add('submit', SubmitType::class, array(
                    'label' => 'Търси',
                ))

        ;


        $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event)
        {

            $form = $event->getForm();
        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

}
