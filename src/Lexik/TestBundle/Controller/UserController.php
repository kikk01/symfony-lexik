<?php

namespace Lexik\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Lexik\TestBundle\Form\UserType;
use Lexik\TestBundle\Entity\User;


class UserController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = new User();
        $formAddUser = $this->createForm(UserType::class, $user);
        $formClientSearch = $this->get('form.factory')->create();
        if($request)
        if($request->isMethod('POST'))
        {
            if(isset($_POST['searchClient']))
            {
                $listUsers = $this
                    ->getDoctrine()
                    ->getRepository('LexikTestBundle:User')
                    ->getClientSearch($_POST['searchClient'])
                ;
            }
            elseif($formAddUser->handleRequest($request)->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $request->getSession()->getFlashbag()->add('notice', 'Utilisateur enregistré.');
                return $this->redirectToRoute('lexik_test_home');
            }
        }
        else
        {
            $listUsers = $this
                ->getDoctrine()
                ->getRepository('LexikTestBundle:User')
                ->findAll();
            ;
        }
        return $this->render('LexikTestBundle:User:view.html.twig', array(
            'listUsers'         => $listUsers,
            'formClientSearch'  => $formClientSearch->createView(),
            'formAddUser'       => $formAddUser->createView()
        ));

    }
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('LexikTestBundle:User')->find($id);

        if ($user === null)
        {
            throw new NotFoundHttpException("L'utilisateur n'existe pas");
        }

        $form = $this->get('form.factory')->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em->remove($user);           
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', "L'utilisateur a bien été supprimé");
            return $this->redirectToRoute('lexik_test_home');
        }
        else
        {
            $request->getSession()->getFlashBag()->add('info', "Une erreur est survenue. Veuillez réessayer");
            return $this->redirectToRoute('lexik_test_home');
        }
    }
    public function addAction(Request $request)
    {
        $user = new User();
        /*$form = $this->creatForm(UserType::class, $user);*/
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $request->getSession()->getFlashbag()->add('notice', 'Utilisateur enregistré.');
            return $this->redirectToRoute('lexik_test_home');
        }
        else
        {
            $request->getSession()->getFlashbag()->add('notice', 'Une erreur est survenu, l\'utilisateur n\'a pas été enregistré.');
            return $this->redirectToRoute('lexik_test_home');
        }
    }
}