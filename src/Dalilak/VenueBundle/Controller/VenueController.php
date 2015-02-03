<?php

namespace Dalilak\VenueBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dalilak\VenueBundle\Entity\Venue;
use Dalilak\VenueBundle\Form\VenueType;

/**
 * Venue controller.
 *
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Controller
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Controller
 *
 * @Route("/venue")
 */
class VenueController extends Controller {

    /**
     * Lists all Venue entities.
     *
     * @Route("/", name="venue")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DalilakVenueBundle:Venue')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Venue entity.
     *
     * @Route("/", name="venue_create")
     * @Method("POST")
     * @Template("DalilakVenueBundle:Venue:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Venue();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $entity->upload();
            $em->persist($entity);
            foreach($entity->getBranches() as $branch) {
                $branch->setVenue($entity);
                $em->persist($branch);
            }

            foreach($entity->getMenus() as $menu) {
                $menu->setVenue($entity);
                $em->persist($menu);
            }

            foreach($entity->getOffers() as $offer) {
                $offer->setVendor($entity);
                $em->persist($offer);
            }

            foreach($entity->getPhones() as $phone) {
                $phone->setVenue($entity);
                $em->persist($phone);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('venue_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Venue entity.
     *
     * @param Venue $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Venue $entity)
    {
        $form = $this->createForm(new VenueType(), $entity, array(
            'action' => $this->generateUrl('venue_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Venue entity.
     *
     * @Route("/new", name="venue_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Venue();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Venue entity.
     *
     * @Route("/{id}", name="venue_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Venue entity.
     *
     * @Route("/{id}/edit", name="venue_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
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
    * Creates a form to edit a Venue entity.
    *
    * @param Venue $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Venue $entity) {
        $form = $this->createForm(new VenueType(), $entity, array(
            'action' => $this->generateUrl('venue_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Venue entity.
     *
     * @Route("/{id}/{redirect_route_name}", name="venue_update")
     * @Method("PUT")
     * @Template("DalilakVenueBundle:Venue:edit.html.twig")
     */
    public function updateAction(Request $request, $id, $redirect_route_name = null) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Venue')->find($id);

        $originalBranches = new \Doctrine\Common\Collections\ArrayCollection();
        $originalMenus = new \Doctrine\Common\Collections\ArrayCollection();
        $originalOffers = new \Doctrine\Common\Collections\ArrayCollection();
        $originalPhones = new \Doctrine\Common\Collections\ArrayCollection();

        // Create an ArrayCollection of the current branch objects in the database
        foreach ($entity->getBranches() as $branch) {
            $originalBranches->add($branch);
        }

        // Create an ArrayCollection of the current menu objects in the database
        foreach ($entity->getMenus() as $menu) {
            $originalMenus->add($menu);
        }

        // Create an ArrayCollection of the current offer objects in the database
        foreach ($entity->getOffers() as $offer) {
            $originalOffers->add($offer);
        }

        // Create an ArrayCollection of the current phone objects in the database
        foreach ($entity->getPhones() as $phone) {
            $originalPhones->add($phone);
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            
            // Fixing the null venu issue
            // for the new added branches
            foreach ($entity->getBranches() as $branch) {
                $branch->setVenue($entity);
                $em->persist($branch);              
            }

            // Fixing the null venu issue
            // for the new added menus
            foreach ($entity->getMenus() as $menu) {
                $menu->setVenue($entity);
                $em->persist($menu);              
            }

            // Fixing the null venu issue
            // for the new added offers
            foreach ($entity->getOffers() as $offer) {
                $offer->setVendor($entity);
                $em->persist($offer);              
            }

            // Fixing the null venu issue
            // for the new added phones
            foreach ($entity->getPhones() as $phone) {
                $phone->setVenue($entity);
                $em->persist($phone);              
            }

            // Updating the currnt branches
            // attached to the venue
            foreach($originalBranches as $branch) {
                if (false === $entity->getBranches()->contains($branch)) {
                    $branch->setVenue(null);
                } else {
                    $branch->setVenue($entity);
                    $em->persist($branch);
                }
            }

            // Updating the currnt menue items
            // attached to the venue
            foreach($originalMenus as $menu) {
                if (false === $entity->getMenus()->contains($menu)) {
                    $menu->setVenue(null);
                } else {
                    $menu->setVenue($entity);
                    $em->persist($menu);
                }
            }

            // Updating the currnt offers
            // attached to the venue
            foreach($originalOffers as $offer) {
                if (false === $entity->getOffers()->contains($offer)) {
                    $offer->setVendor(null);
                } else {
                    $offer->setVendor($entity);
                    $em->persist($offer);
                }
            }

            // Updating the currnt phones
            // attached to the venue
            foreach($originalPhones as $phone) {
                if (false === $entity->getPhones()->contains($phone)) {
                    $phone->setVenue(null);
                } else {
                    $phone->setVenue($entity);
                    $em->persist($phone);
                }
            }

            $em->persist($entity);
            $em->flush();

            if($redirect_route_name != null)
                return $this->redirect($this->generateUrl($redirect_route_name, array('id' => $id)));
            return $this->redirect($this->generateUrl('venue_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Venue entity.
     *
     * @Route("/{id}", name="venue_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DalilakVenueBundle:Venue')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Venue entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('venue'));
    }

    /**
     * Creates a form to delete a Venue entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('venue_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Add venues branches
     *
     * @Route("/{id}/add_branches", name="venue_add_branches")
     * @Template("DalilakVenueBundle:Venue:add_branches.html.twig")
     */
    public function addBranchesAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'redirect_route' => 'venue_add_branches'
        );
    }

    /**
     * Add venue menues
     *
     * @Route("/{id}/add_menues", name="venue_add_menues")
     * @Template("DalilakVenueBundle:Venue:add_menues.html.twig")
     */
    public function addMenuesAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'redirect_route' => 'venue_add_menues'
        );
    }

    /**
     * Add venue offers
     *
     * @Route("/{id}/add_offers", name="venue_add_offers")
     * @Template("DalilakVenueBundle:Venue:add_offers.html.twig")
     */
    public function addOffersAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Venue')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'redirect_route' => 'venue_add_offers'
        );
    }
}
