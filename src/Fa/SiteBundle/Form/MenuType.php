<?php

namespace Fa\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
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
            ->add('link', null, array(
                'label' => 'Link Externo'
            ))
            ->add('pagina', null, array(
                'label' => 'Página Interna'
            ))
            ->add('tipoMenu', null, array(
                'label' => 'Tipo do Menu'
            ))
            ->add('menuPai', null, array(
                'label' => 'Menu Pai'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Fa\SiteBundle\Entity\Menu'
        ));
    }
}
