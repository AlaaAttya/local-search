<?php

namespace Dalilak\VenueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Dalilak\VenueBundle\Form\VenueType;
use Dalilak\VenueBundle\Entity\Venue;

class DefaultController extends Controller {

    /**
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name) {
        return array('name' => $name);
    }

    /**
     * @Route("/test")
     * @Template("DalilakVenueBundle:Default:test.html.twig")
     */
    public function testAction() {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DalilakVenueBundle:Venue')->find(3);
        $form = $this->createForm(new VenueType(), $entity);
        return array(
            'form' => $form->createView()
        );
    }

}
