<?php
namespace Alz\AppBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('gravatarimage', array($this, 'gravatarImgageFilter')),
        );
    }

    public function gravatarImgageFilter($email, $size = 32)
    {
        $default = 'http://bible.soulsurvivor.com/sites/all/themes/ss_bible/images/anonymous-user-gravatar.png';
        $grav_url = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '?d=' . urlencode($default) . '&s=' . $size;
        return $grav_url;
    }

    public function getName()
    {
        return 'app_extension';
    }
}
