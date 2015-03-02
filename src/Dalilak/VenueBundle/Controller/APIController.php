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
     * @Route("/venues/{lang}")
     */
    public function getVenue($lang = null) {
        $request = $this->getRequest();
        $venues = $this->getDoctrine()->getRepository("DalilakVenueBundle:Venue")->findAll();
        $venuesArray = array();
        foreach ($venues as $venue) {
            $venuesArray[] = $venue->toArray(array('lang' => $lang, 'request' => $request));
        }
        return $this->prepareResponse($venuesArray);
    }

    /**
     * Get venue by category alias
     * 
     * @Route("/venue/category/{category_alias}/{limit}/{last_id}/{lang}")
     */
    public function getByCategory($category_alias, $limit = 5, $last_id = null, $lang = 'en') {
        // Fixes limit and last id not required issue
        if(!is_numeric($limit)) {
            $lang = $limit;
            $limit = 5;
        }
        $request = $this->getRequest();
        $venues = $this->getDoctrine()->getRepository('DalilakVenueBundle:Venue')->getByCategoryAlias($category_alias, $limit, $last_id);
        $venuesArray = $this->getAppService('util')->entitiesToArray($venues, array('lang' => $lang, 'request' => $request));
        return $this->prepareResponse($venuesArray);
    }

    /**
     * Get venue by category alias
     * 
     * @Route("/venue/category-id/{category_id}/{limit}/{last_id}/{lang}")
     */
    public function getByCategoryId($category_id, $limit = 5, $last_id = null, $lang = 'en') {
        // Fixes limit and last id not required issue
        if(!is_numeric($limit)) {
            $lang = $limit;
            $limit = 5;
        }
        $request = $this->getRequest();
        $venues = $this->getDoctrine()->getRepository('DalilakVenueBundle:Venue')->getByCategoryId($category_id, $limit, $last_id);
        $venuesArray = $this->getAppService('util')->entitiesToArray($venues, array('lang' => $lang, 'request' => $request));
        return $this->prepareResponse($venuesArray);
    }

    /**
     * @Route("/venue/name/{name}/{limit}/{last_id}/{lang}")
     */
    public function getByName($name, $limit = 5, $last_id = null, $lang = 'en') {
        $request = $this->getRequest();
        $venues = $this->getDoctrine()->getRepository('DalilakVenueBundle:Venue')->findByName($name, $limit, $last_id);
        $venuesArray = $this->getAppService('util')->entitiesToArray($venues, array('lang' => $lang, 'request' => $request));
        return $this->prepareResponse($venuesArray);
    }

    /**
     * Get venue by id
     * 
     * @Route("/venue/{id}/{lang}")
     */
    public function getById($id, $lang = null) {
        $request = $this->getRequest();
        $venue = $this->getDoctrine()->getRepository('DalilakVenueBundle:Venue')->find($id);
        if (count($venue) && isset($venue))
            return $this->prepareResponse($venue->toArray(array('lang' => $lang, 'request' => $request)));
        else
            return $this->prepareResponse(
                array(
                    "error" => array(
                        "code" => "404",
                        "msg" => "Venue not found!"
                        )
                    )
                );
    }

    /**
     * Get all categories
     * 
     * @Route("/category/{lang}")
     */
    public function getAllCategoriesAction($lang = 'en') {
        $categories = $this->getDoctrine()->getRepository('DalilakVenueBundle:Category')->findAll();
        $categoriesArray = $this->getAppService('util')->entitiesToArray($categories, array('lang' => $lang));
        return $this->prepareResponse($categoriesArray);
    }

    /**
     * Get all public services numbers
     * 
     * @Route("/public-numbers/{lang}")
     */
    public function getPublicServicesAction($lang = 'en') {
        $numbers = $this->getDoctrine()->getRepository('DalilakPublicServicesBundle:Phone')->findAll();
        $numbersArray = $this->getAppService('util')->entitiesToArray($numbers, array('lang' => $lang));
        return $this->prepareResponse($numbersArray);
    }

    /**
     * Get all public services numbers
     * 
     * @Route("/offers/{lang}")
     */
    public function getAllOffers($lang = 'en') {
        $request = $this->getRequest();
        $offers = $this->getDoctrine()
        ->getRepository('DalilakVenueBundle:Offer')
        ->findAll();
        $offersArray = $this->getAppService('util')->entitiesToArray($offers, array('lang' => $lang, 'request' => $request, 'has_venue' => true));
        return $this->prepareResponse($offersArray);
    }

    /**
     * Get venue menus
     * 
     * @Route("/venue/{id}/menus")
     */
    public function getVenueMenus($id) {
        $menus = $this->getDoctrine()
        ->getRepository('DalilakVenueBundle:Menu')
        ->findBy(array('venue' => $id));
        $menusArray = $this->getAppService('util')->entitiesToArray($menus);
        return $this->prepareResponse($menusArray);
    }

    /**
     * Get venue branches
     * 
     * @Route("/venue/{id}/branches")
     */
    public function getVenueBranches($id) {
        $branchs = $this->getDoctrine()
        ->getRepository('DalilakVenueBundle:Branch')
        ->findBy(array('venue' => $id));
        $branchsArray = $this->getAppService('util')->entitiesToArray($branchs);
        return $this->prepareResponse($branchsArray);
    }

    /**
     * Get venue branches
     * 
     * @Route("/venue-offers/{venue_id}/{lang}")
     */
    public function getVenueOffers($venue_id, $lang = 'en') {
        $request = $this->getRequest();
        $offers = $this->getDoctrine()
        ->getRepository('DalilakVenueBundle:Offer')
        ->findBy(array('vendor' => $venue_id));
        $offersArray = $this->getAppService('util')->entitiesToArray($offers, array(
                'lang' => $lang, 
                'request' => $request,
            )
        );
        return $this->prepareResponse($offersArray);
    }

    /**
     * Get offer details
     *
     * @param   int $id
     * @Route("/offer/{id}/{lang}")
     */
    public function getOfferDetails($id, $lang = 'en') {
        $request = $this->getRequest();
        $offer = $this->getDoctrine()
                ->getRepository('DalilakVenueBundle:Offer')
                ->findById($id);
        $offerArray = $this->getAppService('util')->entitiesToArray($offer, array(
                'lang' => $lang, 
                'request' => $request,
                'has_venue' => true
            )
        );
        return $this->prepareResponse($offerArray);
    }

    /**
     * Get album images
     * 
     * @Route("/album/images/{album_id}")
     */
    public function getImagesByAlbumId($album_id){
        $request = $this->getRequest();
        $images = $this->getDoctrine()
                ->getRepository('DalilakVenueBundle:Image')
                ->findBy(array('album' => $album_id));
        $imagesArray = $this->getAppService('util')->entitiesToArray($images, array('request' => $request));
        return $this->prepareResponse($imagesArray);
    }

    /**
     * Get venue albums
     *
     * @Route("/venue-albums/{venue_id}")
     */
    public function getVenueAlbums($venue_id){
        $request = $this->getRequest();
        $albums = $this->getDoctrine()
                ->getRepository('DalilakVenueBundle:Album')
                ->findBy(array('venue' => $venue_id));
        $albumsArray = $this->getAppService('util')->entitiesToArray($albums, array('request' => $request));
        return $this->prepareResponse($albumsArray);
    }

    /**
     * Get Ads by category id
     *
     * @Route("/ad/category/{category_id}/{lang}")
     */
    public function getAdsByCategory($category_id, $lang = 'en'){
        $request = $this->getRequest();
        $ads = $this->getDoctrine()
                ->getRepository('DalilakVenueBundle:Ad')
                ->findBy(array('category' => $category_id));
        $adsArray = $this->getAppService('util')->entitiesToArray($ads, array('request' => $request, 'lang' => $lang));
        return $this->prepareResponse($adsArray);
    }

    /**
     * Get Ads by category id
     *
     * @Route("/ad-random/{lang}")
     */
    public function getRandomAd($lang = 'en'){
        $request = $this->getRequest();
        $ads = $this->getDoctrine()
                ->getRepository('DalilakVenueBundle:Ad')
                ->findBy(array('category' => '1'));
        $adsArray = $this->getAppService('util')->entitiesToArray($ads, array('request' => $request, 'lang' => $lang));
        return $this->prepareResponse($adsArray);
    }


}
