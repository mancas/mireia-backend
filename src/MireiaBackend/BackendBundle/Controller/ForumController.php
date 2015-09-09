<?php

namespace MireiaBackend\BackendBundle\Controller;

use MireiaBackend\BackendBundle\Entity\AdminUser;
use MireiaBackend\BackendBundle\Entity\Role;
use MireiaBackend\BackendBundle\Form\Type\AdminUserType;
use MireiaBackend\BackendBundle\Form\Type\RoleType;
use MireiaBackend\BackendBundle\Util\ArrayHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use MireiaBackend\BackendBundle\Controller\CustomController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ForumController extends CustomController
{
    public function listAction()
    {
        $em = $this->getEntityManager();
        $roles = $em->getRepository('BackendBundle:Role')->findAll();

        return $this->render('BackendBundle:Admin:Role/list.html.twig', array('roles' => $roles));
    }

    public function createAction(Request $request)
    {
        $role = new Role();
        $form = $this->createForm(new RoleType(), $role);
        $handler = $this->get('admin.admin_role_form_handler');

        if ($handler->handle($form, $request)) {
            $this->setTranslatedFlashMessage('The new role has been created successfully');

            return $this->redirect($this->generateUrl('super_admin_role_index'));
        } else {
            if ($request->isMethod('POST'))
                $this->setTranslatedFlashMessage('There is an error in your request', 'error');
        }

        return $this->render('BackendBundle:Admin:Role/create.html.twig', array('form' => $form->createView()));
    }

    /**
     * @ParamConverter("role", class="BackendBundle:Role")
     */
    public function editAction(Role $role, Request $request)
    {
        $form = $this->createForm(new RoleType(), $role);
        $handler = $this->get('admin.admin_role_form_handler');

        if ($handler->handle($form, $request)) {
            $this->setTranslatedFlashMessage('The role has been edited successfully');

            return $this->redirect($this->generateUrl('super_admin_role_index'));
        } else {
            if ($request->isMethod('POST'))
                $this->setTranslatedFlashMessage('There is an error in your request', 'error');
        }

        return $this->render('BackendBundle:Admin:Role/create.html.twig', array('edition' => true, 'role' => $role, 'form' => $form->createView()));
    }

    /**
     * @ParamConverter("role", class="BackendBundle:Role")
     */
    public function deleteAction(Role $role)
    {
        $em = $this->getEntityManager();
        $em->remove($role);
        $em->flush();
        $this->setTranslatedFlashMessage('The role has been removed successfully');

        return $this->redirect($this->generateUrl('super_admin_role_index'));
    }
}
