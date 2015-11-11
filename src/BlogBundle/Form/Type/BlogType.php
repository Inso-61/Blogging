<?php

namespace BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BlogType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom du blog :', 'attr' => array(
                'class' => 'form-control')))
            ->add('subtitle', 'text', array('label' => 'Slogan :', 'attr' => array(
                'class' => 'form-control')) )
            ->add('description', 'textarea', array('label' => 'Description :', 'attr' => array(
                'class' => 'form-control')) )
            ->add('about', 'textarea', array('label' => 'A propos :', 'attr' => array(
                'class' => 'tinymce')) )
            ->add('image', 'text', array('label' => 'Image associé :', 'attr' => array(
                'class' => 'form-control')) )
            ->add('logo', 'text', array('label' => 'Logo du blog :', 'attr' => array(
                'class' => 'form-control')) );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Blog'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blogbundle_blog';
    }
}
