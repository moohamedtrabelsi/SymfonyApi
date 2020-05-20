<?php

namespace LibBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="LibBundle\Repository\CategorieRepository")
 */
class Categorie


{
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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


  /*  /**
     * @ORM\OneToMany(targetEntity="LibBundle\Entity\Livre", mappedBy="categorie")
     */
  //  private $livres;


    /**
     * Categorie constructor.
     */
    public function __construct()
    {

        $this->rating=0;

    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function __get($name)
    {
        // TODO: Implement __get() method.
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function get_class(){
        return $this->get_class();
    }

    /**
     * @return ArrayCollection
     */



    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getNom();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     * * @Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "le nom de description doit comporter au moins 3 caractères",
     *      maxMessage = "le nom de description ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     * * @Assert\NotNull(message="Le nom de desc doit etre non null ")
     */
    private $description;





    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255)
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "le nom de l'événement doit comporter au moins 3 caractères",
     *      maxMessage = "le nom de l'événement ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     ** @Assert\NotNull(message="Le nom del'evenement doit etre non null ")
     */
    private $nom;
    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="integer")
     */
    private $rating;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
}

