<?php

namespace Fa\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DestaqueMenuType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('menu', 'choice', array(
                    'choices' => array('instituicao' => 'Nossa Instituição', 'contato' => 'Contato')
                ))
            ->add('texto', 'textarea', array(
                'attr' => array(
                    'rows' => 5,
                    'class' => 'editor',
                    'required' => 'false'
                )
            ))
//            ->add('video')
            ->add('file')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fa\SiteBundle\Entity\DestaqueMenu'
        ));
    }
}
