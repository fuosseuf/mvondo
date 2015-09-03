<?php

namespace Mvondo\VideoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', 'text')
                ->add('description', 'textarea')
                ->add('image', new \Mvondo\SiteBundle\Form\ImageType(), array('required' => false))
                ->add('parent', 'entity', array(
                    'class' => 'MvondoVideoBundle:Category',
                    'property' => 'name',
                    'multiple' => false,
                    'required' => false
                        ))
                ->add('Save', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Mvondo\VideoBundle\Entity\Category'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'mvondo_videobundle_category';
    }

}
