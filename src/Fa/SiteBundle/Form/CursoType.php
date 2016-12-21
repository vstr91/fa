<?php

namespace Fa\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CursoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', null, array(
                'label' => 'Nome'
            ))
            ->add('tipoCurso', null, array(
                'label' => 'Tipo de Curso',
                'attr' => array(
                    'required' => 'required'
                )
            ))
//            ->add('periodoCurso', null, array(
//                'label' => 'Período (Matutino, Integral ou Noturno)',
//                'attr' => array(
//                    'required' => 'required'
//                )
//            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fa\SiteBundle\Entity\Curso'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fasitebundle_curso';
    }
}
