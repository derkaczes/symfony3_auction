<?php

namespace AppBundle\Twig;

class DateExtension extends \Twig_Extension
{
    /**
     * @returm array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter("expireDate", [$this, "expireDate"])
        ];
    }

    public function expireDate(\DateTime $expiresAt)
    {
        if($expiresAt < new \DateTime("-7 days")) {
            return $expiresAt->format("Y-m-d H:i");
        }

        if($expiresAt > new \DateTime("-1 days")) {
            return "za " . $expiresAt->format("d") . "dni";
        }

        return "za " . $expiresAt->format("H") . "godz. " . $expiresAt->format("i") . " min.";
    }
}