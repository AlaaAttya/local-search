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
        
        foreach ($entityArray as $entity) {
                $resultsArray[] = $entity->toArray($params);
        }

        return $resultsArray;
    }

}
