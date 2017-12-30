<?php

namespace Lexik\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->get('form.factory')->create();
        if($request->isMethod('POST'))
        {
            $listUsers = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('LexikTestBundle:User')
                ->getClientSearch($_POST['searchClient'])
            ;
        }
        else
        {
            $listUsers = $this->getDoctrine()
                ->getRepository('LexikTestBundle:User')
                ->findAll();
            ;
        }
        return $this->render('LexikTestBundle:User:view.html.twig', array(
            'listUsers' => $listUsers,
            'form'      => $form->createView(),
        ));

    }
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('LexikTestBundle:User')->find($id);
        $group_nameName = $user->getGroup()->getName();
        var_dump($user);

        if ($user === null)
        {
            throw new NotFoundHttpException("L'utilisateur n'existe pas");
        }

        $form = $this->get('form.factory')->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            var_dump('coucou');
            $em->remove($user);
            
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée");
            return $this->redirectToRoute('lexik_test_home');
        }
        /*else
        {
            $request->getSession()->getFlashBag()->add('info', "Une erreur est survenue. Veuillez réessayé");
            return $this->redirectToRoute('lexik_test_home');
        }*/
    }
}