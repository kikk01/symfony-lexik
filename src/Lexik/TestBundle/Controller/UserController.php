<?php

namespace Lexik\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Lexik\TestBundle\Form\UserType;
use Lexik\TestBundle\Entity\User;
use Lexik\TestBundle\Form\Group_nameType;
use Lexik\TestBundle\Entity\Group_name;

class UserController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = new User();
        $formAddUser = $this->createForm(UserType::class, $user);
        $group_name = new Group_name();
        $formDeleteUsers = $this->createForm(Group_nameType::class, $group_name);
        $formClientSearch = $this->get('form.factory')->create();

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
                $request->getSession()->getFlashbag()->add('info', 'Utilisateur enregistré.');
                return $this->redirectToRoute('lexik_test_home');
            }
            else
            {                
                $form = $this->createForm(Group_nameType::class, $group_name);
                
                $form->handleRequest($request); 
                if ($form->isValid())
                {
                    foreach($_POST['lexik_testbundle_group_name']['users'] as $id)
                    {
                        $user = new User;
                        $em = $this->GetDoctrine()->getManager();
                        $user = $em->getRepository(User::class)->find($id); 
                        $em->remove($user);
                    }
                    $em->flush();
                    /*$request->getSession()->getFlashbag()->add('info', 'Utilisateurs suprimés.');
                    return $this->redirectToRoute('lexik_test_home');*/
                } 
            }                    
        }
        else
        {
            $listUsers = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->MyFindAll()
            ;

        }
        return $this->render('LexikTestBundle:User:view.html.twig', array(
            'listUsers'         => $listUsers,
            'formClientSearch'  => $formClientSearch->createView(),
            'formAddUser'       => $formAddUser->createView(),
            'formDeleteUsers'   => $formDeleteUsers->createView()
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('LexikTestBundle:User')->find($id);
        $form = $this->get('form.factory')->create();
        if ($user === null)
        {
            throw new NotFoundHttpException("L'utilisateur n'existe pas");
        } 
        elseif ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em->remove($user);           
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', "L'utilisateur a bien été supprimé");
            return $this->redirectToRoute('lexik_test_home');
        }
    }
}