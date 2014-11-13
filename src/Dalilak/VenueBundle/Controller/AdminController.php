<?php

namespace Dalilak\VenueBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Address
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Controller
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Controller
 * 
 * @Route("/admin")
 */
class AdminController extends BaseController{
    
    /**
     * @Route("/", name="admin_index")
     * @Template("DalilakVenueBundle:Admin:index.html.twig")
     */
    public function indexAction(){
        return array();
    }
}
