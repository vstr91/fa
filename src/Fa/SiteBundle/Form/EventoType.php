<?php

namespace Fa\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('descricao', null, array(
                'attr' => array(
                    'rows' => 10,
                    'class' => 'editor'
                )
            ))
            ->add('file')
            ->add('data', 'datetime', array(
                'widget' => "single_text",
                'format' => 'dd-MM-yyyy HH:mm',
                'html5' => false,
                'attr' => array(
                    'class' => 'datetimepicker form-control'
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fa\SiteBundle\Entity\Evento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fasitebundle_evento';
    }
}
