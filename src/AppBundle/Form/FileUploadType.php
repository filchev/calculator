<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FileUploadType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $policyOptions = $options['read_only']['policy'];
        if (isset($options['read_only']['policy']) && !empty($options['read_only']['policy'])) {

            if ($policyOptions->getHasDriverLicensePhoto() === true) {
                $builder
                        ->add('imageFile', 'file', [
                            "label" => "app_file_upload.driver_license",
                            'translation_domain' => 'translations',
                                ]
                        )
                ;
            }

            if ($policyOptions->getHasCarDocumentsPhoto() === true) {
                $builder
                        ->add('carDocumentsImageFile', 'file', [
                            "label" => "app_file_upload.car_documents",
                            'translation_domain' => 'translations',
                                ]
                        )
                ;
            }
        }


        $builder
                ->add('submit', 'submit', [
                    'label' => 'Поръчай'
                ])

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\FileUpload'
        ));
    }

}
