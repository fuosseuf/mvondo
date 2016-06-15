<?php

namespace Mvondo\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('type', 'entity', array(
                    'class' => 'MvondoEventBundle:TypeEvent',
                    'property' => 'name',
                    'multiple' => FALSE,
                    'required' => TRUE,
                ))
                ->add('title', 'text', array('required' => true))
                ->add('description', 'textarea', array('required' => true))
                ->add('dateEvent', 'date', array('required' => true))
                ->add('hour', 'time', array('required' => true))
                ->add('location', 'text')
                ->add('contact', 'text', array('required' => FALSE))
                ->add('website', 'url', array('required' => FALSE))
                ->add('flyer', new \Mvondo\SiteBundle\Form\ImageType(), array('required' => false))
                ->add('country', 'entity', array(
                    'class' => 'MvondoSiteBundle:Country',
                    'property' => 'name',
                    'multiple' => FALSE,
                    'required' => FALSE,
                ))
                ->add('enregistrer', 'submit')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Mvondo\EventBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'mvondo_eventbundle_event';
    }

}
