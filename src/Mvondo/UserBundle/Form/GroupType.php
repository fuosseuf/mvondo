<?php

namespace Mvondo\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class GroupType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('role', 'choice', array(
            'label' => 'Role : ',
            'label_attr' => array('class' => 'col-sm-3 control-label'),
            'attr' => array('class' => 'form-control col-sm-7'),
            'required' => true,
            'choices' => array(
                'ROLE_ADMIN' => 'Admin Priveleges',
                'ROLE_ARTIST' => 'Artist Priveleges',
                'ROLE_USER' => 'User Privileges',
                )
            )
        );
    }

    /**
     * @return string
     */
    public function getName() {
        return 'mvondo_userbundle_group';
    }

    public function getParent() {
        return 'fos_user_group';
    }

}
