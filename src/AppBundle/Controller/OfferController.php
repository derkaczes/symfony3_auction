<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Auction;
use AppBundle\Form\BidType;
use AppBundle\Entity\Offer;

class OfferController extends Controller {

    /**
     * @Route("/auction/buy/{id}", name="offer_buy", methods={"POST"})
     * 
     * @param Auction $auction
     * 
     * @return RedirectResponse
     */
    public function buyAction(Auction $auction) {
        $offer = new Offer();
        $offer
            ->setAuction($auction)
            ->setType(Offer::TYPE_BUY)
            ->setPrice($auction->getPrice());

        $auction
            ->setStatus(Auction::STATUS_FINISHED)
            ->setExpiresAt(new \DateTime());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($auction);
        $entityManager->persist($offer);
        $entityManager->flush();

        $this->addFlash("success", "Kupiłeś przedmiot: {$auction->getTitle()} za kwotę: {$offer->getPrice()} zł.");

        return $this->redirectToRoute("auction_details", ["id" => $auction->getId()]);
    }

    /**
     * @Route("/auction/bid/{id}", name="offer_bid", methods={"POST"})
     * 
     * @param Request $request
     * @param Auction $auction
     * 
     * @return RedirectResponse
     */
    public function bidAction(Request $request, Auction $auction) {
        $offer = new Offer();
        $bidForm = $this->createForm(BidType::class, $offer);
        $bidForm->handleRequest($request);

        if($bidForm->isValid()) {
            $offer
                ->setType(Offer::TYPE_BID)
                ->setAuction($auction);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($offer);
            $entityManager->flush();

            $this->addFlash("success", "Złożyłęś oferte na przedmiot: {$auction->getTitle()} za kwotę: {$offer->getPrice()} zł.");
        } else {
            $this->addFlash("error", "Nie udało się zalicytować przedmiotu: {$auction->getTitle()}.");
        }

        return $this->redirectToRoute("auction_details", ["id" => $auction->getId()]);
    }
    
}