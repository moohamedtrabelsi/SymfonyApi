<?php

namespace LogistiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * chambre
 *
 * @ORM\Table(name="chambre")
 * @ORM\Entity(repositoryClass="LogistiqueBundle\Repository\chambreRepository")
 */
class chambre
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
     * @ORM\ManyToOne(targetEntity="LogistiqueBundle\Entity\foyer", inversedBy="chambres")
     */
    private $foyer;

    public function __toString()
    {
        return strval( $this->getId() );
    }

    /**
     * @return string
     */
    public function getEtage()
    {
        return $this->etage;
    }

    /**
     * @param string $etage
     */
    public function setEtage($etage)
    {
        $this->etage = $etage;
    }

    /**
     * @return int
     */
    public function getNbrLit()
    {
        return $this->nbrLit;
    }

    /**
     * @param int $nbrLit
     */
    public function setNbrLit($nbrLit)
    {
        $this->nbrLit = $nbrLit;
    }

    /**
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="etage", type="string", length=255)
     */
    private $etage;
    /**
     * @var int
     *
     * @ORM\Column(name="nbr_lit", type="integer")
     */
    private $nbrLit;

    /**
     * @return mixed
     */
    public function getFoyer()
    {
        return $this->foyer;
    }

    /**
     * @param mixed $foyer
     */
    public function setFoyer($foyer)
    {
        $this->foyer = $foyer;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

