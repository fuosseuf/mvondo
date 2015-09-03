<?php

namespace Mvondo\VideoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VideoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('description', 'textarea')
            ->add('playerKey', 'text')
//            ->add('dateAdd')
//            ->add('dateUp')
//            ->add('status')
//            ->add('signaled')
//            ->add('deleted')
            ->add('origin', 'entity', array(
                'class'=> 'MvondoVideoBundle:Origin',
                'property' => 'name',
                'multiple' => FALSE
            ))
            ->add('categories', 'entity', array(
                'class'=> 'MvondoVideoBundle:Category',
                'property' => 'name',
                'multiple' => TRUE
            ))
            ->add('image', new \Mvondo\SiteBundle\Form\ImageType())
            ->add('country', 'entity', array(
                'class'=> 'MvondoSiteBundle:Country',
                'property' => 'name',
                'multiple' => FALSE,
                'required' => FALSE
            ))
            ->add('save', 'submit')    
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mvondo\VideoBundle\Entity\Video'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mvondo_videobundle_video';
    }
}
