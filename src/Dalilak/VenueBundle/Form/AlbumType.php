<?php

namespace Dalilak\VenueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dalilak\VenueBundle\Form\ImageType;

/**
 * Album Form
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Form
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Form
 * 
 */
class AlbumType extends AbstractType {
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            //->add('venue')
            ->add('description', 'text', array('required' => false))
            ->add('description_ar', 'text', array('required' => false))
            ->add('images', 'collection', array(
                    'type' => new ImageType(),
                    'allow_add' => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'prototype' => true,
                    'options' => array(
                        'data_class' => 'Dalilak\VenueBundle\Entity\Image'
                    )
                )
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Dalilak\VenueBundle\Entity\Album'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'dalilak_venuebundle_album';
    }
}
