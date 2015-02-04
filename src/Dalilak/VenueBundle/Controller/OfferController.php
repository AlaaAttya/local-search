<?php

namespace Dalilak\VenueBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dalilak\VenueBundle\Entity\Offer;
use Dalilak\VenueBundle\Form\OfferType;

/**
 * Offer controller.
 *
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Controller
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Controller
 *
 * @Route("/offer")
 */
class OfferController extends Controller {

    /**
     * Lists all Offer entities.
     *
     * @Route("/", name="offer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DalilakVenueBundle:Offer')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Offer entity.
     *
     * @Route("/{venue_id}/", name="offer_create")
     * @Method("POST")
     * @Template("DalilakVenueBundle:Offer:new.html.twig")
     */
    public function createAction(Request $request, $venue_id) {
        $entity = new Offer();
        $form = $this->createCreateForm($entity, array('venue_id' => $venue_id));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $venue = $this->getDoctrine()->getRepository("DalilakVenueBundle:Venue")->find($venue_id);
            
            if(!$venue) 
                throw $this->createNotFoundException('Venue does not exist');

            $entity->setVendor($venue);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('offer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Offer entity.
     *
     * @param Offer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Offer $entity, $route_params) {
        $form = $this->createForm(new OfferType(), $entity, array(
            'action' => $this->generateUrl('offer_create', array('venue_id' => $route_params['venue_id'])),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Offer entity.
     *
     * @Route("/{venue_id}/new", name="offer_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($venue_id) {
        
        $venue = $this->getDoctrine()->getRepository("DalilakVenueBundle:Venue")->find($venue_id);          
        if(!$venue) 
            throw $this->createNotFoundException('Venue does not exist');

        $entity = new Offer();
        $form   = $this->createCreateForm($entity, array('venue_id' => $venue_id));

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Offer entity.
     *
     * @Route("/{id}", name="offer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DalilakVenueBundle:Offer')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Offer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Offer entity.
     *
     * @Route("/{id}/edit", name="offer_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('DalilakVenueBundle:Offer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Offer entity.');
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
    * Creates a form to edit a Offer entity.
    *
    * @param Offer $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Offer $entity) {
        $form = $this->createForm(new OfferType(), $entity, array(
            'action' => $this->generateUrl('offer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Offer entity.
     *
     * @Route("/{id}", name="offer_update")
     * @Method("PUT")
     * @Template("DalilakVenueBundle:Offer:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Offer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Offer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('offer_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Offer entity.
     *
     * @Route("/{id}", name="offer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DalilakVenueBundle:Offer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Offer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('offer'));
    }

    /**
     * Creates a form to delete a Offer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offer_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
