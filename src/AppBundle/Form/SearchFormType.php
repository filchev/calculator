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
                ->add('driver_age', EntityType::class, [
                    "label" => "app_search_engine.driver_age",
                    'translation_domain' => 'translations',
                    'class' => 'AppBundle\Entity\Driver',
                    'choice_label' => 'getLabelFromTo',
                ])
                ->add('vehicle_type', EntityType::class, [
                    "label" => "app_search_engine.viechle_purpose",
                    'translation_domain' => 'translations',
                    'class' => 'AppBundle\Entity\VehicleUsedFor',
                ])
                ->add('engine_capacity', EntityType::class, [
                    "label" => "app_search_engine.engine_capacity",
                    'translation_domain' => 'translations',
                    'class' => 'AppBundle\Entity\EngineCapacity',
                    'choice_label' => 'getLabelFromTo',
                ])
                ->add('region', EntityType::class, [
                    "label" => "app_search_engine.viechle_region",
                    'translation_domain' => 'translations',
                    'class' => 'AppBundle\Entity\Region',
                ])
                ->add('damageInsurance', EntityType::class, [
                    'empty_data' => null,
                    'placeholder' => "",
                    "label" => "app_search_engine.demage_insurance",
                    'translation_domain' => 'translations',
                    'required' => false,
                    'class' => 'AppBundle\Entity\DamageInsurance',
                ])
                ->add('wheelDirection', EntityType::class, [
                    'empty_data' => null,
                    'placeholder' => "app_search_engine.wheel_placeholder",
                    "label" => "app_search_engine.wheel_direction",
                    'translation_domain' => 'translations',
                    'required' => false,
                    'class' => 'AppBundle\Entity\WheelDirection',
                ])
                ->add('others', EntityType::class, [
                    "label" => "app_search_engine.others",
                    'translation_domain' => 'translations',
                    'multiple' => true,
                    'expanded' => true,
                    'class' => 'AppBundle\Entity\OtherTax',
                ])
                ->add('submit', SubmitType::class, array(
                    "label" => "app_search_engine.search",
                    'translation_domain' => 'translations',
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
