<?php
namespace Alz\AppBundle\EventListener;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Alz\AppBundle\Controller\AppInController;

class AppListener
{
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        if (!$controller[0] instanceof AppInController) {
            return;
        }

        if ('alz_app_premium_cancelar' === $event->getRequest()->get('_route')) {
            return;
        }

        if ('alz_app_premium_comprar' === $event->getRequest()->get('_route')) {
            return;
        }

        if ($event->getRequest()->cookies->has('premium')) {
            $url = $controller[0]->generateUrl('alz_app_premium_comprar');
            return $event->setController(function() use ($url) {
                return new RedirectResponse($url);
            });
        }

        if ('alz_app_empresa_editar' === $event->getRequest()->get('_route')) {
            return;
        }

        if (!$controller[0]->getEmpresa()) {
            $event->getRequest()->getSession()->getFlashBag()->add(
                'warning',
                $controller[0]->get('translator')->trans('Debes añadir los datos de la empresa para empezar a utilizar la aplicación.')
            );

            $url = $controller[0]->generateUrl('alz_app_empresa_editar');
            return $event->setController(function() use ($url) {
                return new RedirectResponse($url);
            });
        }
    }
}
