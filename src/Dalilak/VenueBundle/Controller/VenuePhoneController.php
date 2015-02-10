<?php

namespace Dalilak\VenueBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dalilak\VenueBundle\Entity\VenuePhone;
use Dalilak\VenueBundle\Form\VenuePhoneType;

/**
 * VenuePhone controller.
 *
 *
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Controller
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Controller
 *
 * @Route("/venuephone")
 */
class VenuePhoneController extends Controller {

    /**
     * Lists all VenuePhone entities.
     *
     * @Route("/", name="venuephone")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DalilakVenueBundle:VenuePhone')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new VenuePhone entity.
     *
     * @Route("/", name="venuephone_create")
     * @Method("POST")
     * @Template("DalilakVenueBundle:VenuePhone:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new VenuePhone();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('venuephone_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a VenuePhone entity.
     *
     * @param VenuePhone $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(VenuePhone $entity) {
        $form = $this->createForm(new VenuePhoneType(), $entity, array(
            'action' => $this->generateUrl('venuephone_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new VenuePhone entity.
     *
     * @Route("/new", name="venuephone_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new VenuePhone();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a VenuePhone entity.
     *
     * @Route("/{id}", name="venuephone_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:VenuePhone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VenuePhone entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing VenuePhone entity.
     *
     * @Route("/{id}/edit", name="venuephone_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:VenuePhone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VenuePhone entity.');
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
     * Creates a form to edit a VenuePhone entity.
     *
     * @param VenuePhone $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(VenuePhone $entity) {
        $form = $this->createForm(new VenuePhoneType(), $entity, array(
            'action' => $this->generateUrl('venuephone_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    
    /**
     * Edits an existing VenuePhone entity.
     *
     * @Route("/{id}", name="venuephone_update")
     * @Method("PUT")
     * @Template("DalilakVenueBundle:VenuePhone:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:VenuePhone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find VenuePhone entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('venuephone_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Deletes a VenuePhone entity.
     *
     * @Route("/{id}", name="venuephone_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DalilakVenueBundle:VenuePhone')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find VenuePhone entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('venuephone'));
    }

    /**
     * Creates a form to delete a VenuePhone entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('venuephone_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
