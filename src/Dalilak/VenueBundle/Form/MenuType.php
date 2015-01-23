<?php

namespace Dalilak\VenueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * Menu Form Type
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Entity
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category FormType
 */
class MenuType extends AbstractType {
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('item_name', 'text', array('required' => false))
            ->add('ingerdients', 'text', array('required' => false))
            ->add('size1', 'text', array('required' => false))
            ->add('size1_price', 'text', array('required' => false))
            ->add('size2', 'text', array('required' => false))
            ->add('size2_price', 'text', array('required' => false))
            ->add('size3', 'text', array('required' => false))
            ->add('size3_price', 'text', array('required' => false))
            //->add('venue')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Dalilak\VenueBundle\Entity\Menu'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'dalilak_venuebundle_menu';
    }
}
