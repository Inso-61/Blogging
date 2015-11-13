<?php

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('objet', 'text', array('label' => 'Objet', 'attr' => array(
                'class' => 'form-control')))
            ->add('commentaire', 'textarea', array('label' => 'Commentaire', 'attr' => array(
                'class' => 'form-control')))
            ->add('article', 'text', array('label' => 'Article', 'attr' => array(
                'class' => 'form-control')))
            ->add('user', 'text', array('label' => 'Utilisateur', 'attr' => array(
                'class' => 'form-control')))
            ->add('date', 'text', array('label' => 'Date', 'attr' => array(
                'class' => 'form-control')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Comments'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blogbundle_comments';
    }
}
