<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{
    public function indexAction()
    {
    	$user = $this->get('security.context')->getToken()->getUser();
        if ( $user instanceof \Dalilak\UserBundle\Entity\User) {
            return $this->redirect( $this->generateUrl('venue') );
        } else {
        	return $this->redirect( $this->generateUrl('fos_user_security_login') );
        }
        
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
        return $this->render('AcmeDemoBundle:Welcome:index.html.twig');
    }
}
