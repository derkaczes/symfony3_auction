<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends Controller {
    /**
     * @Route("/", name="auction_index")
     * 
     * @return Response
     */
    public function indexAction() {
        $auctions = [
            [
                "id" => 1,
                "title" => "Super samochód",
                "desctription" => "opis super samochodu",
                "price" => "1000zł",
            ],
            [
                "id" => 2,
                "title" => "Super samochód",
                "desctription" => "opis super samochodu",
                "price" => "1000zł",
            ],
            [
                "id" => 3,
                "title" => "Super samochód",
                "desctription" => "opis super samochodu",
                "price" => "1000zł",
            ],
        ];

        return $this->render("Auction/index.html.twig", ["auctions" => $auctions]);
    }
    /**
     * @Route("/{id}", name="auction_details")
     * 
     * @param $id
     */
    public function detailsAction($id) {
        return $this->render("");
    }
}