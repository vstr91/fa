<?php

namespace Fa\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoCursoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descricao', 'textarea', array(
                'label' => 'Descrição',
                'attr' => array(
                    'rows' => 10,
                    'class' => 'editor'
                )
            ))
            ->add('perfil', 'textarea', array(
                'label' => 'Perfil',
                'attr' => array(
                    'rows' => 10,
                    'class' => 'editor'
                )
            ))
            ->add('mercado', 'textarea', array(
                'label' => 'Mercado de Trabalho',
                'attr' => array(
                    'rows' => 10,
                    'class' => 'editor'
                )
            ))
            ->add('ingresso', 'textarea', array(
                'label' => 'Formas de Ingresso',
                'attr' => array(
                    'rows' => 10,
                    'class' => 'editor'
                )
            ))
            ->add('ato', null, array(
                'label' => 'Ato Autorizativo',
                'attr' => array(
                    'rows' => 10,
                    'class' => 'editor'
                )
            ))
            ->add('contato', null, array(
                'label' => 'Fale com o Diretor',
                'attr' => array(
                    'rows' => 10,
                    'class' => 'editor'
                )
            ))
            ->add('fileDocentes', 'file', array(
                'label' => 'Corpo Docente',
                'required' => false
            ))
            ->add('fileMatriz', 'file', array(
                'label' => 'Matriz Curricular',
                'required' => false
            ))
            ->add('resultadoMec', null, array(
                'label' => 'Resultado das Avaliações do MEC',
                'attr' => array(
                    'rows' => 10,
                    'class' => 'editor'
                )
            ))
            ->add('mensalidades', null, array(
                'label' => 'Mensalidades',
                'attr' => array(
                    'rows' => 10,
                    'class' => 'editor'
                )
            ))
            ->add('fileConvenios', 'file', array(
                'label' => 'Convênios',
                'required' => false
            ))
            ->add('duracao', null, array(
                'label' => 'Duração (em semestres)'
            ))
            ->add('mensalidadeMatutino', null, array(
                'label' => 'Mensalidade (Matutino)',
                'attr' => array(
                    'class' => 'dinheiro'
                )
            ))
            ->add('mensalidadeNoturno', null, array(
                'label' => 'Mensalidade (Noturno)',
                'attr' => array(
                    'class' => 'dinheiro'
                )
            ))
            ->add('mensalidadeIntegral', null, array(
                'label' => 'Mensalidade (Integral)',
                'attr' => array(
                    'class' => 'dinheiro'
                )
            ))
            ->add('file', null, array(
                'label' => 'Banner'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fa\SiteBundle\Entity\InfoCurso'
        ));
    }
}
