<?php

namespace LogistiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * bus
 *
 * @ORM\Table(name="bus")
 * @ORM\Entity(repositoryClass="LogistiqueBundle\Repository\busRepository")
 */
class bus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="LogistiqueBundle\Entity\ligne", inversedBy="buss")
     */
    private $ligne;

    public function getLigne()
    {
        return $this->ligne;
    }


    public function __toString()
    {
        return strval( $this->getId() );
    }

    public function setLigne(ligne $ligne)
    {
        $this->ligne = $ligne;

        return $this;
    }





    /**
     * @var int
     *
     * @ORM\Column(name="nbr_place", type="integer")
     */
    private $nbrPlace;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set nbrPlace
     *
     * @param integer $nbrPlace
     *
     * @return bus
     */
    public function setNbrPlace($nbrPlace)
    {
        $this->nbrPlace = $nbrPlace;

        return $this;
    }

    /**
     * Get nbrPlace
     *
     * @return int
     */
    public function getNbrPlace()
    {
        return $this->nbrPlace;
    }
}

