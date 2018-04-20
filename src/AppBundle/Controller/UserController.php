<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function loginAction(Request $request)
    {
        $user = new User();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        $form = $this->createForm('AppBundle\Form\LoginType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            foreach ($users as $us){
                if($us->getPassword() === $encoder->encodePassword($user->getPassword(),'') && $us->getPseudo() === $user->getPseudo()){
                    if(isset($_SESSION)) {
                        $this->showAction($us);
                    }
                    session_destroy();
                    session_start(array($us));
                    return $this->showAction($us);
                }
            }
            // replace this example code with whatever you need
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'login_form' => $form->createView(),
                'reConnect' => 1
            ]);
        }
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'login_form' => $form->createView(),
            'reConnect' => 0
        ]);
    }

    /**
     * Lists all user entities.
     *
     * @Route("/admin", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm('AppBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user->setSalt('');

            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));

            $em->persist($user);
            $em->flush();
            // replace this example code with whatever you need

            session_destroy();
            session_start(array($user));
            return $this->showAction($user);
        }

        return $this->render('user/new.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $persos = $em->getRepository('AppBundle:Perso')->findAll();
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'persos' => $persos,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('AppBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $factory = $this->get('security.encoder_factory');
            $user->setSalt('');
            $encoder = $factory->getEncoder($user);
            $user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
            'user' => $user,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
