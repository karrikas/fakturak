<?php

namespace Alz\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FacturaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', null, array('label' => 'Número'))
            ->add('fecha', 'date', array(
                'label' => 'Fecha',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
            ))
            ->add('total', 'hidden', array('label' => 'Total'))
            ->add('totaliva', 'hidden', array('label' => 'Total con IVA'))
            ->add('empresainfo', null, array('label' => 'Empresa'))
            ->add('clienteinfo', null, array('label' => 'Cliente'))
            ->add('informacion')
            //->add('empresa')
            //->add('cliente')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Alz\AppBundle\Entity\Factura'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'alz_appbundle_factura';
    }
}
