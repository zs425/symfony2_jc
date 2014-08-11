<?php

namespace JetCharters\AppBundle\Controller\Admin;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JetCharters\AppBundle\Entity\OperatorUser;
use JetCharters\AppBundle\Entity\Operator;
use JetCharters\AppBundle\Form\OperatorType;
use JetCharters\AppBundle\Form\Admin\OperatorBillingType;
use JetCharters\AppBundle\Form\Admin\OperatorAssignAircraftType;

/**
 * OperatorUser controller.
 *
 * @Route("/admin/operators")
 */
class OperatorsController extends Controller
{

    private function getUserManager() {
        // Set discriminator to Operators
	
        $discriminator = $this->container->get('pugx_user.manager.user_discriminator')->setClass('JetCharters\AppBundle\Entity\Operator');
        // $discriminator;
	
        return $this->container->get('pugx_user_manager');
    }

    /**
     * Lists all OperatorUser entities.
     *
     * @Route("/", name="admin_operators")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('JetChartersAppBundle:OperatorUser')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new OperatorUser entity.
     *
     * @Route("/", name="admin_operators_create")
     * @Method("POST")
     * @Template("JetChartersAppBundle:Admin\Operators:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $um = $this->getUserManager();
        $entity = $um->createUser();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $password = $form["password"]->getData();

            $entity->setPlainPassword($password);
            $entity->setEnabled(true);

            $um->updateUser($entity, true);

            return $this->redirect($this->generateUrl('admin_operators', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a OperatorUser entity.
    *
    * @param OperatorUser $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(OperatorUser $entity)
    {
        $form = $this->createForm(new OperatorType(), $entity, array(
            'action' => $this->generateUrl('admin_operators_create'),
            'method' => 'POST',
        ));

        $form
             ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new OperatorUser entity.
     *
     * @Route("/new", name="admin_operators_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $um = $this->getUserManager();
        
        $entity = $um->createUser();
	
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a OperatorUser entity.
     *
     * @Route("/{id}/", name="admin_operators_show")
     * @Method("GET")
     * @Template()
     */
    // public function showAction($id)
    // {
    //     $um = $this->getUserManager();
    //     $entity = $um->findUserBy(array('id' => $id));

    //     if (!$entity) {
    //         throw $this->createNotFoundException('Unable to find OperatorUser entity.');
    //     }

    //     $deleteForm = $this->createDeleteForm($id);

    //     return array(
    //         'entity'      => $entity,
    //         'delete_form' => $deleteForm->createView(),
    //     );
    // }

    /**
     * Displays a form to edit an existing OperatorUser entity.
     *
     * @Route("/{id}/edit", name="admin_operators_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $um = $this->getUserManager();
        $entity = $um->findUserBy(array('id' => $id));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OperatorUser entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a OperatorUser entity.
    *
    * @param OperatorUser $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OperatorUser $entity)
    {
        $form = $this->createForm(new OperatorType(), $entity, array(
            'action' => $this->generateUrl('admin_operators_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => false,
                'first_options'  => array('label' => 'New Password'),
                'second_options' => array('label' => 'Repeat New Password'),
            ))
            ->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing OperatorUser entity.
     *
     * @Route("/{id}", name="admin_operators_update")
     * @Method("PUT")
     * @Template("JetChartersAppBundle:Admin\Operators:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $um = $this->getUserManager();
        $entity = $um->findUserBy(array('id' => $id));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OperatorUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $password = $editForm["password"]->getData();
            $entity->setPlainPassword($password);
            $um->updateUser($entity, true);

            return $this->redirect($this->generateUrl('admin_operators'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a OperatorUser entity.
     *
     * @Route("/{id}", name="admin_operators_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $um = $this->getUserManager();
            $entity = $um->findUserBy(array('id' => $id));

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OperatorUser entity.');
            }

            $um->deleteUser($entity);
        }

        return $this->redirect($this->generateUrl('admin_operators'));
    }

    /**
     * Creates a form to delete a OperatorUser entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_operators_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * @Route("/{op_username}/billing", name="admin_operators_billing")
     * @Template()
     */
    public function billingAction(Request $request, $op_username)
    {
        $um = $this->getUserManager();
        $entity = $um->findUserBy(array('username' => $op_username));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find current User.');
        }

        $editForm = $this->createForm(new OperatorBillingType(), $entity, array(
            'method' => 'PUT',
        ));

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid() && $request->getMethod() == "PUT") {
            $um->updateUser($entity, true);

            $this->get('session')->getFlashBag()->add(
            'success',
            'Your changes were saved!'
            );

            // return $this->redirect($this->generateUrl('admin_operators_billing', array('op_username' => $op_username)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
            );
    }

    /**
     * @Route("/assign_aircraft/{op_username}", name="admin_operators_assign_aircraft")
     * @Template()
     */
    public function assignAircraftAction(Request $request, $op_username)
    {
        $entity = $this->getUserManager()->findUserBy(array('username' => $op_username))->getCompany();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find current User.');
        }

        $editForm = $this->createForm(new OperatorAssignAircraftType(), $entity, array(
            'method' => 'PUT',
        ));

        $aircraft = new \JetCharters\AppBundle\Entity\CharterAircraft();

        $editForm->add('submit', 'submit', array('label' => 'Update'));

        $editForm->handleRequest($request);

        if ($editForm->isValid() && $request->getMethod() == "PUT") {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
            'success',
            'Your changes were saved!'
            );

            return $this->redirect($this->generateUrl('admin_operators_assign_aircraft', array('op_username' => $op_username)));
        }

        // TODO: aircraft assignments not persisting

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'op_username' => $op_username
            );
    }

    /**
     * @Route("/aircraftlog", name="admin_aircraft_status_log")
     * @Template()
     */
    public function aircraftStatusLogAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository("JetChartersAppBundle:AircraftStatusLog")->findAll();

        return array('entities' => $entities);
    }
}
