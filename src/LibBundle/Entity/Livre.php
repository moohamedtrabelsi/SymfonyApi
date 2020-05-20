<?php

namespace LibBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Livre
 *
 * @ORM\Table(name="livre")
 * @ORM\Entity(repositoryClass="LibBundle\Repository\LivreRepository")
 */
$propertyAccessor = PropertyAccess::createPropertyAccessor();

class Livre
{


    /**
     * Livre constructor.
     * @param $categorie
     */
    public function __construct()
    {
        $this->nbv =0;
        $this->rating=1;
        $this->setNbj(0);
        $this->titre ='titre';
        $this->disponible='true';
    }


    /**
     *
     */
    public function incj()
    {
        $this->nbj++;
    }
    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }



    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="integer")
     */
    private $rating;


    /**
     * @return int
     */
    public function getNbv()
    {
        return $this->nbv;
    }

    /**
     * @param int $nbv
     */
    public function setNbv($nbv)
    {
        $this->nbv = $nbv;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="nbv", type="integer")
     */
    private $nbv;

    /**
     * @return int
     */
    public function getNbj()
    {
        return $this->nbj;
    }

    /**
     * @param int $nbj
     */
    public function setNbj($nbj)
    {
        $this->nbj = $nbj;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="nbj", type="integer")
     */
    private $nbj;


    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @return mixed
     */
    public function get_class(){
        return $this->get_class();
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
     * @ORM\ManyToOne(targetEntity="LibBundle\Entity\Categorie")
     *
     */
    private $categorie;
    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=255)
     * @Assert\Length(
     *      min = 3,
     *      max = 15,
     *      minMessage = "le nom de l'événement doit comporter au moins 3 caractères",
     *      maxMessage = "le nom de l'événement ne doit pas dépasser les {{limit}} 15 caractères"
     *
     * )
     ** @Assert\NotNull(message="Le nom del'evenement doit etre non null ")
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="disponible", type="string", length=255)
     * @Assert\Length(
     *      min = 3,
     *      max = 6,
     *      minMessage = "le nom de l'événement doit comporter au moins 3 caractères",
     *      maxMessage = "le nom de l'événement ne doit pas dépasser les {{limit}} 6 caractères"
     *
     * )
     ** @Assert\NotNull(message="Le nom del'evenement doit etre non null ")
     */
    private $disponible;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Livre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }
    /**
     * Get disponible
     *
     * @return string
     */
    public function getDisponible()
    {
        return $this->disponible;
    }


    /**
     * Set disponible
     *
     * @param $titre
     * @return String
     */
    public function setDisponible($titre)
    {
        $this->disponible = $titre;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {

        return $this->getTitre() ;
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
    }
}

