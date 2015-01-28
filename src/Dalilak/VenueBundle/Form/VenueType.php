<?php

namespace Dalilak\VenueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dalilak\VenueBundle\Form\BranchType;
use Dalilak\VenueBundle\Form\MenuType;
use Dalilak\VenueBundle\Form\OfferType;

/**
 * Venue Form
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Form
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Form
 * 
 */
class VenueType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', 'text', array('required' => true))
                ->add('nameAr', 'text', array('required' => false))
                ->add('email', 'email', array('required' => true))
                ->add('facebook', 'text', array('required' => false))
                ->add('twitter', 'text', array('required' => false))
                ->add('website', 'text', array('required' => false))
                ->add('openingTimes', 'text', array('required' => false))
                ->add('openingTimes_ar', 'text', array('required' => false))
                ->add('offers', 'text', array('required' => false))
                ->add('services', 'text', array('required' => false))
                ->add('services_ar', 'text', array('required' => false))
                ->add('address_text', 'text', array('required' => false))
                ->add('address_text_ar', 'text', array('required' => false))
                ->add('address_longitude', 'text', array('required' => false))
                ->add('address_latitude', 'text', array('required' => false))
                ->add('categories')
                ->add('branches', 'collection', array(
                    'type' => new BranchType(),
                    'allow_add' => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'prototype' => true,
                    'options' => array(
                        'data_class' => 'Dalilak\VenueBundle\Entity\Branch'
                    )
                        )
                )
                ->add('menus', 'collection', array(
                    'type' => new MenuType(),
                    'allow_add' => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'prototype' => true,
                    'options' => array(
                        'data_class' => 'Dalilak\VenueBundle\Entity\Menu'
                    )
                        )
                )
                ->add('offers', 'collection', array(
                    'type' => new OfferType(),
                    'allow_add' => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'prototype' => true,
                    'options' => array(
                        'data_class' => 'Dalilak\VenueBundle\Entity\Offer'
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
            'data_class' => 'Dalilak\VenueBundle\Entity\Venue'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'dalilak_venuebundle_venue';
    }

}
