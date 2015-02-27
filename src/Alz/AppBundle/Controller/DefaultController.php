<?php
namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Alz\AppBundle\Entity\Empresa;
use Alz\AppBundle\Entity\UserClone;
use Alz\AppBundle\Form\EmpresaType;

class DefaultController extends AlzController
{
    public function indexAction(Request $request)
    {
        return $this->redirect($this->generateUrl('alz_app_factura_listado'));
    }
}
