<?php

namespace Dalilak\VenueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Branch Form Type
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Entity
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category FormType
 */
class BranchType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('area')

                ->add('address_text', 'text', array('required' => false))
                ->add('address_longitude', 'text', array('required' => false))
                ->add('address_latitude', 'text', array('required' => false))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Dalilak\VenueBundle\Entity\Branch'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'dalilak_venuebundle_branch';
    }

}
