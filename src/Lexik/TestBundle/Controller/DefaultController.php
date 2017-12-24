<?php

namespace Lexik\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LexikTestBundle:Default:index.html.twig');
    }
}
