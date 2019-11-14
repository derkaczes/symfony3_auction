<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuctionController extends Controller {
    /**
     * @return Response
     */
    public function indexAction() {
        return $this->render("");
    }
}