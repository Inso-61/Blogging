<?php

namespace BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nom de l\'article', 'attr' => array(
        'class' => 'form-control')) )
            ->add('content', 'textarea', array('label' => 'Contenu', 'attr' => array(
                'class' => 'tinymce', 'required' => false)) )
            ->add('categorie', 'entity', array(
                                    'label' => 'Catégorie',
                                    'class' => 'BlogBundle:Category',
                                    'property' => 'name',
                                    'empty_value' => null,
                                    'multiple' => false,
                'attr' => array(
                'class' => 'form-control')) )
            ->add('image', 'text', array('label' => 'Image associé', 'required' => false, 'attr' => array(
                'class' => 'form-control')) );
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blogbundle_article';
    }
}
