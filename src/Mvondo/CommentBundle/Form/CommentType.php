<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentType
 *
 * @author Steve
 */
namespace Mvondo\CommentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentType extends AbstractType{
  

    public function getName() {
     
        return 'commentbundle_comment';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('content', 'textarea')
            ;
    }
//put your code here
}
