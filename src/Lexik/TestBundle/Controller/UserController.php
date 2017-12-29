<?php

namespace Lexik\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function indexAction()
    {
        $listUsers = $this->getDoctrine()
            ->getRepository('LexikTestBundle:User')
            ->findAll();
        ;
         
        /*foreach($listUsers AS $user)
        {
            $userGroup = $user->getGroup()->getName();
        }*/
        return $this->render('LexikTestBundle:User:view.html.twig', array(
            'listUsers' => $listUsers,
        ));
    }
}