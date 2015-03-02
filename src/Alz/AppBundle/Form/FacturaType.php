<?php
namespace Alz\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class FacturaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', 'hidden', array('label' => 'Número'))
            ->add('fecha', 'date', array(
                'attr' => array('style'=>'display:none;'),
                'label' => 'Fecha',
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
            ))
            ->add('total', 'hidden', array('label' => 'Total'))
            ->add('totaliva', 'hidden', array('label' => 'Total con IVA'))
            ->add('empresainfo', 'hidden', array('label' => 'Empresa'))
            ->add('clienteinfo', 'hidden', array('label' => 'Cliente'))
            ->add('informacion', null, array('label' => 'Texto información'))
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
