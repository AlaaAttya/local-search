<?php

namespace Dalilak\VenueBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Wraping app utility functions
 *  
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Services
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Service
 */
class UtilService {

    protected $_container;

    public function __construct($container) {
        $this->_container = $container;
    }

    /**
     * Turn Array of Entitities to array
     * 
     * @param   Entity  $entityArray
     * @param   array   $params
     * @return array
     */
    public function entitiesToArray($entityArray, $params = array()) {
        $resultsArray = array();
        // Return venue object or not
        $has_venue = true;
        if(!isset($params['has_venue']))
            $has_venue = false;
        
        foreach ($entityArray as $entity) {
            if(isset($params['lang']))
                $resultsArray[] = $entity->toArray($has_venue, $params['lang']);
            else 
                $resultsArray[] = $entity->toArray();
        }

        return $resultsArray;
    }

}
