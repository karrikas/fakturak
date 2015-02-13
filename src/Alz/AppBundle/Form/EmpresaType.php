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
            ->add('nombre', null, array('label' => 'Razón social'))
            ->add('cif', null, array('label' => 'CIF o NIF'))
            ->add('direccion1', null, array('label' => 'Dirección'))
            ->add('direccion2', null, array('label' => 'Dirección'))
            ->add('cp', null, array('label' => 'Código postal'))
            ->add('region', null, array('label' => 'Provincia'))
            ->add('ciudad', null, array('label' => 'Ciudad'))
            ->add('telefono', null, array('label' => 'Teléfono'))
            ->add('fax', null, array('label' => 'Fax'))
            ->add('email', null, array('label' => 'E-mail'))
            ->add('logo', null, array('label' => 'Imagen del logotipo'))
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
