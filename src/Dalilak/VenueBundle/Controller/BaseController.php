<?php

namespace Dalilak\VenueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Address
 * 
 * @author Alaa Attya <alaa.attya91@gmail.com> 
 * @package Dalilak.VenueBundle.Controller
 * @version 1.0
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @category Controller
 */
class BaseController extends Controller {

    /**
     * Prepare response object of a PHP array
     * 
     * @param array $params
     * @return Response
     */
    public function prepareResponse(array $params) {
        $response = new Response();
        $response->setContent(json_encode($params));
        $response->headers->set('Content-Type', 'application/json');
        if(isset($_GET['callback'])){
            $response->setContent($_GET['callback'] . "(" . json_encode($params) . ")");        
        }
        return $response;
    }

    public function getParam(Request $request, $paramName) {

        if ($param = $request->request->get($paramName)) {
            return $param;
        } else {
            throw new \Exception("$paramName is missing", "0");
        }
    }

    /**
     * Get service by name
     * 
     * @param string $serviceName
     * @return Service
     */
    public function getAppService($serviceName) {
        return $this->container->get("Dalilak.$serviceName.service");
    }

    /**
     * Validate request method
     * 
     * @param Request $request
     * @param string $method
     */
    public function validateRequestMethod(Request $request, $method) {
        if ($request->getMethod() == $method) {
            return TRUE;
        } else {
            throw new \Exception("Invalid request method, $method is request only allowed!", '0');
        }
    }

}
