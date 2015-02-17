<?php
namespace Alz\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AlzController extends Controller
{
    public function checkEmpresa($empresa_id)
    {
        $user = $this->getDoctrine()
        ->getRepository('AlzAppBundle:UserClone')
        ->find($this->getUser()->getId());

        foreach ($user->getEmpresas() as $empresa)
        {
            if ($empresa_id == $empresa->getId()) {
                return true;
            }
        }

        throw $this->createAccessDeniedException('You cannot access this page!');
    }

    public function getEmpresa()
    {
        $user = $this->getDoctrine()
        ->getRepository('AlzAppBundle:UserClone')
        ->find($this->getUser()->getId());

        foreach ($user->getEmpresas() as $empresa)
        {
            return $empresa;
        }

        throw $this->createAccessDeniedException('You cannot access this page!');
    }
}
