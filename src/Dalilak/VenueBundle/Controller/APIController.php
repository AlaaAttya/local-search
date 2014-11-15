<?php

namespace Dalilak\VenueBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Address
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Controller
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Controller
 * 
 * @Route("/api/v1")
 */
class APIController extends BaseController {

    /**
     * @Route("/venues")
     */
    public function getVenue() {
        $venues = $this->getDoctrine()->getRepository("DalilakVenueBundle:Venue")->findAll();
        $venuesArray = array();
        foreach ($venues as $venue) {
            $venuesArray[] = $venue->toArray();
        }
        return $this->prepareResponse($venuesArray);
    }

    /**
     * Get venue by category alias
     * 
     * @Route("/venue/category/{category_alias}/{limit}/{last_id}")
     */
    public function getByCategory($category_alias, $limit = 5, $last_id = null) {
        $venues = $this->getDoctrine()->getRepository('DalilakVenueBundle:Venue')->getByCategoryAlias($category_alias, $limit, $last_id);
        $venuesArray = $this->getAppService('util')->entitiesToArray($venues);
        return $this->prepareResponse($venuesArray);
    }

    /**
     * @Route("/venue/name/{name}/{limit}/{last_id}")
     */
    public function getByName($name, $limit = 5, $last_id = null) {
        $venues = $this->getDoctrine()->getRepository('DalilakVenueBundle:Venue')->findByName($name, $limit, $last_id);
        $venuesArray = $this->getAppService('util')->entitiesToArray($venues);
        return $this->prepareResponse($venuesArray);
    }

    /**
     * Get venue by id
     * 
     * @Route("/venue/{id}")
     */
    public function getById($id) {
        $venue = $this->getDoctrine()->getRepository('DalilakVenueBundle:Venue')->find($id);
        return $this->prepareResponse($venue->toArray());
    }

}
