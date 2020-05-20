<?php

namespace LogistiqueBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ligne
 *
 * @ORM\Table(name="ligne")
 * @ORM\Entity(repositoryClass="LogistiqueBundle\Repository\ligneRepository")
 */
class ligne
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
     * @ORM\OneToMany(targetEntity="LogistiqueBundle\Entity\bus", mappedBy="ligne")
     */
    private $buss;

    /**
     * @ORM\OneToMany(targetEntity="LogistiqueBundle\Entity\abonnement", mappedBy="ligne")
     */
    private $abonnements;

    public function __constructs()
    {
        $this->abonnements = new ArrayCollection();
    }


    public function __construct()
    {
        $this->buss = new ArrayCollection();
    }



    /**
     * @return Collection|abonnement[]
     */
    public function getabonnements()
    {
        return $this->abonnements;
    }

    /**
     * @return Collection|bus[]
     */
    public function getBuss()
    {
        return $this->buss;
    }

    public function __toString()
    {
        return $this->getArrivee();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=255)
     * * @Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "le nom de depart doit comporter au moins 3 caractères",
     *      maxMessage = "le nom de depart ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     * * @Assert\NotNull(message="Le nom de desc doit etre non null ")
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="arrivee", type="string", length=255)
     * * @Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "le nom de depart doit comporter au moins 3 caractères",
     *      maxMessage = "le nom de depart ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     * * @Assert\NotNull(message="Le nom de desc doit etre non null ")
     */
    private $arrivee;


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
     * Set depart
     *
     * @param string $depart
     *
     * @return ligne
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return string
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set arrivee
     *
     * @param string $arrivee
     *
     * @return ligne
     */
    public function setArrivee($arrivee)
    {
        $this->arrivee = $arrivee;

        return $this;
    }

    /**
     * Get arrivee
     *
     * @return string
     */
    public function getArrivee()
    {
        return $this->arrivee;
    }
}

