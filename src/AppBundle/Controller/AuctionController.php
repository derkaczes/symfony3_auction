<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Auction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AuctionController extends Controller {
    /**
     * @Route("/", name="auction_index")
     * 
     * @return Response
     */
    public function indexAction() {
        $entityManager = $this->getDoctrine()->getManager();
        $auctions = $entityManager->getRepository(Auction::class)->findAll();

        return $this->render("Auction/index.html.twig", ["auctions" => $auctions]);
    }

    /**
     * @Route("/{id}", name="auction_details")
     * s
     * @param $id
     */
    public function detailsAction($id) {
        return $this->render("Auction/details.html.twig");
    }

    /**
     * @Route("/auction/add", name="auction_add")
     * 
     * @return Response
     */
    public function addAction() {
        $auction = new Auction();
        $form = $this->createFormBuilder($auction)
            ->add("title", TextType::class)
            ->add("description", TextareaType::class)
            ->add("price", NumberType::class)
            ->add("submit", SubmitType::class)
            ->getForm();
        return $this->render("Auction/add.html.twig", ["form" => $form->createView()]);
    }
}