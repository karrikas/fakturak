<?php
namespace Alz\AppBundle\Twig;

/**
 * Extension
 */
class AppExtension extends \Twig_Extension
{
    /**
     * getFilters
     *
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('gravatarimage', array($this, 'gravatarImgageFilter')),
            new \Twig_SimpleFilter('monedatipo', array($this, 'monedaTipoFilter')),
            new \Twig_SimpleFilter('monedaformato', array($this, 'monedaFormatoFilter')),
            new \Twig_SimpleFilter('monedaformatoangular', array($this, 'monedaFormatoToAngularFilter')),
        );
    }

    /**
     * Parsear la información del formato para prepararlo para angular sfcurrency
     * @param string $formato
     * @param string $simbolo
     *
     * @return string
     */
    public function monedaFormatoToAngularFilter($formato, $simbolo)
    {
        list($decimales, $decimalesSeparador, $milesSeparador, $posicionSimbolo) = explode('|', $formato);
        $simbolo = $this->monedaTipoFilter($simbolo);

        return ":$decimales:\"$decimalesSeparador\":\"$milesSeparador\":\"$posicionSimbolo\":\"$simbolo\"";
    }

    /**
     * Filter
     * @param float  $numero
     * @param string $formato
     * @param string $simbolo
     *
     * @return string
     */
    public function monedaFormatoFilter($numero, $formato, $simbolo)
    {
        list($decimales, $decimalesSeparador, $milesSeparador, $posicionSimbolo) = explode('|', $formato);

        $numero = number_format($numero, $decimales, $decimalesSeparador, $milesSeparador);
        $simbolo = $this->monedaTipoFilter($simbolo);

        if ($posicionSimbolo == 'i') {
            return "$simbolo $numero";
        }

        if ($posicionSimbolo == 'f') {
            return "$numero $simbolo";
        }

        return $numero;
    }

    /**
     * Filter
     * @param string $tipo
     *
     * @return string
     */
    public function monedaTipoFilter($tipo)
    {
        $name = array('EUR', 'USD', 'GBP');
        $simbolo = array('€', '$', '£');

        return str_replace($name, $simbolo, $tipo);
    }

    /**
     * Filter
     * @param string  $email
     * @param integer $size
     *
     * @return string
     */
    public function gravatarImgageFilter($email, $size = 32)
    {
        $default = 'http://bible.soulsurvivor.com/sites/all/themes/ss_bible/images/anonymous-user-gravatar.png';
        $gravUrl = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?d=' . urlencode($default) . '&s=' . $size;

        return $gravUrl;
    }

    /**
     * Filter
     *
     * @return string
     */
    public function getName()
    {
        return 'app_extension';
    }
}
