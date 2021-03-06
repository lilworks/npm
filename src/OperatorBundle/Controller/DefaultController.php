<?php

namespace OperatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        var_dump($this->container->get( 'kernel' )->getEnvironment());
        return $this->render('OperatorBundle:Default:index.html.twig');
    }
    public function menuAction()
    {
        return $this->render('OperatorBundle:Default:menu.html.twig');
    }
}
