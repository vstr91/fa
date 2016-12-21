<?php

namespace Fa\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NoticiaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', null, array(
                'label' => 'Título'
            ))
            ->add('resumo', null, array(
                'label' => 'Resumo',
                'attr' => array(
                    'rows' => 5,
                    'class' => 'editor'
                )
            ))
            ->add('descricao', null, array(
                'label' => 'Descrição',
                'attr' => array(
                    'rows' => 10,
                    'class' => 'editor'
                )
            ))
            ->add('file', null, array(
                'label' => 'Imagem'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fa\SiteBundle\Entity\Noticia'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fasitebundle_noticia';
    }
}
