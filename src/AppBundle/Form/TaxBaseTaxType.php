<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TaxBaseTaxType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('tax', EntityType::class, [
                    'empty_value' => true,
                    "label" => ' ',
//                    'translation_domain' => 'translations',
                    'class' => 'AppBundle\Entity\Tax',
                    'choice_label' => 'getLabelFromTo',
                    'choice_attr' => function ($allChoices, $currentChoiceKey)
                    {
                        if ($currentChoiceKey !== null && $allChoices->getCategory() != null) {
                            return array("category" => $allChoices->getCategory()->getId());
                        } else {
                            return array();
                        }
                    }
                        ]
                    )

                ;
            }

            /**
             * @param OptionsResolver $resolver
             */
            public function configureOptions(OptionsResolver $resolver)
            {
                $resolver->setDefaults(array(
                    'data_class' => 'AppBundle\Entity\TaxBaseTax'
                ));
            }

        }
        