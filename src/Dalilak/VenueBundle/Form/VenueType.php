<?php

namespace Dalilak\VenueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VenueType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('nameAr')
            ->add('email')
            ->add('facebook')
            ->add('twitter')
            ->add('website')
            ->add('openingTimes')
            ->add('offers')
            ->add('services')
            ->add('address')
            ->add('categories')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dalilak\VenueBundle\Entity\Venue'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dalilak_venuebundle_venue';
    }
}
