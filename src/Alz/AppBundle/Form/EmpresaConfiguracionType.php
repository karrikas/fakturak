<?php

namespace Alz\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaConfiguracionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('monedatipo', 'choice', array(
                'choices' => array(
                    'EUR' => 'EUR - €',
                    'USD' => 'USD - $',
                    'GBP' => 'GBP - £',
                ),
                'label' => 'Tipo de moneda',
            ))
            ->add('monedaformato', 'choice', array(
                'choices' => array(
                    '2|,|.|f' => '1.234,00 €',
                    '2|.|,|f' => '1,234.00 €',
                    '2|,| |f' => '1 234,00 €',
                    '2|.| |f' => '1 234.00 €',
                    '2|,|.|i' => '€ 1.234,00',
                    '2|.|,|i' => '€ 1,234.00',
                    '2|,| |i' => '€ 1 234,00',
                    '2|.| |i' => '€ 1 234.00',
                    '2|,|.|' => '1.234,00',
                    '2|.|,|' => '1,234.00',
                    '2|,| |' => '1 234,00',
                    '2|.| |' => '1 234.00',
                ),
                'label' => 'Formato de la moneda',
            ))
            ->add('mensajefacturas', null, array('label' => 'Mensaje informativo para las facturas'))
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

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getLogo()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getLogo()->move(
            '~/Documents',
            $this->getLogo()->getClientOriginalName()
        );
    }
}
