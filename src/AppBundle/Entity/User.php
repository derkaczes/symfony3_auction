<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Auction[]/ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="Auction", mappedBy="owner")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $auctions;

    /**
     * User constructor.
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->auctions = new ArrayCollection();
    }

    /**
     * @return Auction[]/ArrayCollection
     */
    public function getAuctions() {
        return $this->auctions;
    }

    /**
     * @param Auction $auction
     * 
     * @return $this
     */
    public function addAuction(Auction $auction) {
        $this->auctions[] = $auction;
        return $this;
    }
}
