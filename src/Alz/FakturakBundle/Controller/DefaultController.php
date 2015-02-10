<?php

namespace Alz\FakturakBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $request->setLocale('eu');
        return $this->render('AlzFakturakBundle::index.html.twig');
    }
}
