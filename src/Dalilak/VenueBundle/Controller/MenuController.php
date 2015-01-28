<?php

namespace Dalilak\VenueBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dalilak\VenueBundle\Entity\Menu;
use Dalilak\VenueBundle\Form\MenuType;

/**
 * Menu controller.
 *
 * @Route("/menue") 
 */
class MenuController extends Controller
{

    /**
     * Lists all Menu entities.
     *
     * @Route("/", name="menu")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DalilakVenueBundle:Menu')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Menu entity.
     *
     * @Route("/", name="menu_create")
     * @Method("POST")
     * @Template("DalilakVenueBundle:Menu:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Menu();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('menu_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Menu entity.
     *
     * @param Menu $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Menu $entity)
    {
        $form = $this->createForm(new MenuType(), $entity, array(
            'action' => $this->generateUrl('menu_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Menu entity.
     *
     * @Route("/venue/{venue_id}/menus", name="menu_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($venue_id) {
        // Check venue existence
        $em = $this->getDoctrine()->getManager();

        $venue = $em->getRepository('DalilakVenueBundle:Venue')->find($venue_id);
        $menue_items = array();
        if (!$venue) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        } else {
            $menue_items = $venue->getMenus();
        }

        $entity = new Menu();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'menue_items' => $menue_items,
            'item_string' => '<div id="dalilak_venuebundle_venue_menus___name__" ><div><label for="dalilak_venuebundle_venue_menus___name___item_name">Item name</label><input type="text" id="dalilak_venuebundle_venue_menus___name___item_name" name="dalilak_venuebundle_venue[menus][__name__][item_name]" /></div><div><label for="dalilak_venuebundle_venue_menus___name___ingerdients">Ingerdients</label><input type="text" id="dalilak_venuebundle_venue_menus___name___ingerdients" name="dalilak_venuebundle_venue[menus][__name__][ingerdients]" /></div><div><label for="dalilak_venuebundle_venue_menus___name___size1">Size1</label><input type="text" id="dalilak_venuebundle_venue_menus___name___size1" name="dalilak_venuebundle_venue[menus][__name__][size1]" /></div><div><label for="dalilak_venuebundle_venue_menus___name___size1_price">Size1 price</label><input type="text" id="dalilak_venuebundle_venue_menus___name___size1_price" name="dalilak_venuebundle_venue[menus][__name__][size1_price]" /></div><div><label for="dalilak_venuebundle_venue_menus___name___size2">Size2</label><input type="text" id="dalilak_venuebundle_venue_menus___name___size2" name="dalilak_venuebundle_venue[menus][__name__][size2]" /></div><div><label for="dalilak_venuebundle_venue_menus___name___size2_price">Size2 price</label><input type="text" id="dalilak_venuebundle_venue_menus___name___size2_price" name="dalilak_venuebundle_venue[menus][__name__][size2_price]" /></div><div><label for="dalilak_venuebundle_venue_menus___name___size3">Size3</label><input type="text" id="dalilak_venuebundle_venue_menus___name___size3" name="dalilak_venuebundle_venue[menus][__name__][size3]" /></div><div><label for="dalilak_venuebundle_venue_menus___name___size3_price">Size3 price</label><input type="text" id="dalilak_venuebundle_venue_menus___name___size3_price" name="dalilak_venuebundle_venue[menus][__name__][size3_price]" /></div></div>'
        );
    }

    /**
     * Finds and displays a Menu entity.
     *
     * @Route("/{id}", name="menu_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Menu entity.
     *
     * @Route("/{id}/edit", name="menu_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
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
    * Creates a form to edit a Menu entity.
    *
    * @param Menu $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Menu $entity)
    {
        $form = $this->createForm(new MenuType(), $entity, array(
            'action' => $this->generateUrl('menu_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Menu entity.
     *
     * @Route("/{id}", name="menu_update")
     * @Method("PUT")
     * @Template("DalilakVenueBundle:Menu:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Menu')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Menu entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('menu_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Menu entity.
     *
     * @Route("/{id}", name="menu_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DalilakVenueBundle:Menu')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Menu entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('menu'));
    }

    /**
     * Creates a form to delete a Menu entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('menu_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
