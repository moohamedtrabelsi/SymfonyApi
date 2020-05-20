<?php

namespace LogistiqueBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * foyer
 *
 * @ORM\Table(name="foyer")
 * @ORM\Entity(repositoryClass="LogistiqueBundle\Repository\foyerRepository")
 */
class foyer
{
    /**
     * @return mixed
     */
    public function getChambres()
    {
        return $this->chambres;
    }

    /**
     * @param mixed $chambres
     */
    public function setChambres($chambres)
    {
        $this->chambres = $chambres;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\OneToMany(targetEntity="LogistiqueBundle\Entity\chambre", mappedBy="foyer")
     */
    private $chambres;

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return int
     */
    public function getNbrChambre()
    {
        return $this->nbrChambre;
    }

    /**
     * @param int $nbrChambre
     */
    public function setNbrChambre($nbrChambre)
    {
        $this->nbrChambre = $nbrChambre;
    }

    public function __construct()
    {
        $this->chambres = new ArrayCollection();
    }


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;
    /**
     * @var int
     *
     * @ORM\Column(name="nbr_chambre", type="integer")
     */
    private $nbrChambre;
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

