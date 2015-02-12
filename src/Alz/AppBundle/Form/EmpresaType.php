<?php

namespace Alz\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('cif')
            ->add('direccion1')
            ->add('direccion2')
            ->add('cp')
            ->add('region')
            ->add('ciudad')
            ->add('telefono')
            ->add('fax')
            ->add('email')
            ->add('logo')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alz\AppBundle\Entity\Empresa'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'alz_appbundle_empresa';
    }
}
