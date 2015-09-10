<?php

namespace Mvondo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text')
            ->add('lastname', 'text')
            ->add('biography', 'textarea', array('required' => false))
            ->add('group', 'entity', array(
                'class'=> 'MvondoUserBundle:Group',
                'property' => 'name',
                'multiple' => FALSE
            ))
            ->add('profil', new \Mvondo\SiteBundle\Form\ImageType(), array('required' => false))
            ->add('country', 'entity', array(
                'class'=> 'MvondoSiteBundle:Country',
                'property' => 'name',
                'multiple' => FALSE,
                'required' => FALSE,
            ))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mvondo_userbundle_user';
    }
    
    public function getParent() {
        return 'fos_user_registration';
    }
}
