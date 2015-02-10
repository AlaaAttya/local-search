<?php

namespace Dalilak\VenueBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dalilak\VenueBundle\Entity\Album;
use Dalilak\VenueBundle\Entity\Image;
use Dalilak\VenueBundle\Form\AlbumType;

/**
 * Album controller.
 *
 * @Route("/album")
 */
class AlbumController extends Controller {

    /**
     * Lists all Album entities.
     *
     * @Route("/", name="album")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DalilakVenueBundle:Album')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Album entity.
     *
     * @Route("/venue/{venue_id}", name="album_create")
     * @Method("POST")
     * @Template("DalilakVenueBundle:Album:new.html.twig")
     */
    public function createAction(Request $request, $venue_id) {
        $entity = new Album();
        $form = $this->createCreateForm($entity, $venue_id);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $venue = $em->getRepository('DalilakVenueBundle:Venue')->find($venue_id);
        if(!$venue) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $entity->setVenue($venue);

        if ($form->isValid()) {
            $entity->setVenue($venue);
            $images = $entity->getImages();
            foreach ($images as $image) {
                // a new file to be uploaded
                if($image->getImageFile() != null) {
                    $new_image = new Image();
                    $new_image->setImageFile($image->getImageFile());
                    $new_image->upload(); 
                    $new_image->setAlbum($entity);
                    $entity->addImage($new_image);
                    $em->persist($new_image);
                }                 
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('album_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Album entity.
     *
     * @param Album $entity The entity
     * @param $venue_id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Album $entity, $venue_id) { 
        $form = $this->createForm(new AlbumType(), $entity, array(
            'action' => $this->generateUrl('album_create', array('venue_id' => $venue_id)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Album entity.
     *
     * @Route("/venue/{venue_id}/new", name="album_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($venue_id) {
        $entity = new Album();
        $em = $this->getDoctrine()->getManager();

        $venue = $em->getRepository('DalilakVenueBundle:Venue')->find($venue_id);
        if(!$venue) {
            throw $this->createNotFoundException('Unable to find Venue entity.');
        }

        $form   = $this->createCreateForm($entity, $venue_id);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Album entity.
     *
     * @Route("/{id}", name="album_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Album entity.
     *
     * @Route("/{id}/edit", name="album_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }


        $images = array();
        $request = $this->getRequest();
        foreach ($entity->getImages() as $image) {
            $images[] = $image->getImageName($request);
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'images' => $images
        );
    }

    /**
     * Creates a form to edit a Album entity.
     *
     * @param Album $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Album $entity) {
        $form = $this->createForm(new AlbumType(), $entity, array(
            'action' => $this->generateUrl('album_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Album entity.
     *
     * @Route("/{id}", name="album_update")
     * @Method("PUT")
     * @Template("DalilakVenueBundle:Album:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Album')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Album entity.');
        }

        $originalImages = new \Doctrine\Common\Collections\ArrayCollection();
        $imgs = $entity->getImages();
        foreach ($entity->getImages() as $img) {
            $originalImages->add($img);
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);


        if ($editForm->isValid()) {

            $images = $entity->getImages();
            foreach ($images as $image) {
                // a new file to be uploaded
                if($image->getImageFile() != null) {
                    $new_image = new Image();
                    $new_image->setImageFile($image->getImageFile());
                    $new_image->upload(); 
                    $new_image->setAlbum($entity);
                    $entity->addImage($new_image);
                    $em->persist($new_image);
                }                 
            }
            
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('album_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Album entity.
     *
     * @Route("/{id}", name="album_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DalilakVenueBundle:Album')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Album entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('album'));
    }

    /**
     * Creates a form to delete a Album entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('album_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
