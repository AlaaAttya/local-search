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
class APIController extends BaseController{
    
    /**
     * @Route("/venues")
     */
    public function getVenue(){
        $venues = $this->getDoctrine()->getRepository("DalilakVenueBundle:Venue")->findAll();
        $venuesArray = array();
        foreach ($venues as $venue){
            $venuesArray[] = $venue->toArray();
        }
        return $this->prepareResponse($venuesArray);
    }
    
    /**
     * Get venue by category alias
     * 
     * @Route("/venue/category/{category_alias}")
     */
    public function getByCategory($category_alias){
        $venues = $this->getDoctrine()->getRepository('DalilakVenueBundle:Venue')->getByCategoryAlias($category_alias);
        $venuesArray = $this->getAppService('util')->entitiesToArray($venues);
        return $this->prepareResponse($venuesArray);
    }
}
