<?php

namespace ClassesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe")
 * @ORM\Entity(repositoryClass="ClassesBundle\Repository\ClasseRepository")
 */
class Classe
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrEtudiants", type="integer")
     */
    private $nbrEtudiants;


    /**
     * @ORM\ManyToOne(targetEntity="Branche")
     * @ORM\JoinColumn(name="branche_id",referencedColumnName="id")
     */
    private $branche;


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
     * @return Classe
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

    /**
     * Set nbrEtudiants
     *
     * @param integer $nbrEtudiants
     *
     * @return Classe
     */
    public function setNbrEtudiants($nbrEtudiants)
    {
        $this->nbrEtudiants = $nbrEtudiants;

        return $this;
    }

    /**
     * Get nbrEtudiants
     *
     * @return int
     */
    public function getNbrEtudiants()
    {
        return $this->nbrEtudiants;
    }

    /**
     * Set branche
     *
     * @param \ClassesBundle\Entity\Branche $branche
     *
     * @return Classe
     */
    public function setBranche(\ClassesBundle\Entity\Branche $branche = null)
    {
        $this->branche = $branche;

        return $this;
    }

    /**
     * Get branche
     *
     * @return \ClassesBundle\Entity\Branche
     */
    public function getBranche()
    {
        return $this->branche;
    }
}
