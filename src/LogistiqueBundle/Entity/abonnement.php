<?php

namespace LogistiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * abonnement
 *
 * @ORM\Table(name="abonnement")
 * @ORM\Entity(repositoryClass="LogistiqueBundle\Repository\abonnementRepository")
 */
class abonnement
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
     * @ORM\ManyToOne(targetEntity="ligne", inversedBy="abonnements")
     */
    private $ligne;
    public function __toString()
    {
        return strval( $this->getId() );
    }

    /**
     * @return mixed
     */
    public function getLigne()
    {
        return $this->ligne;
    }

    /**
     * @param mixed $ligne
     */
    public function setLigne($ligne)
    {
        $this->ligne = $ligne;
    }

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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * * @Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "le nom de description doit comporter au moins 3 caractères",
     *      maxMessage = "le nom de description ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     * * @Assert\NotNull(message="Le nom de desc doit etre non null ")
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     * * @Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "le nom de description doit comporter au moins 3 caractères",
     *      maxMessage = "le nom de description ne doit pas dépasser les {{limit}} 50 caractères"
     *
     * )
     * * @Assert\NotNull(message="Le nom de desc doit etre non null ")
     */
    private $prenom;
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

