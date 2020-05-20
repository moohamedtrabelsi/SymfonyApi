<?php

namespace LibBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="LibBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @ORM\ManyToOne(targetEntity="LibBundle\Entity\Livre", inversedBy="reservations")
     */
    private $livre;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="reservations")
     */
    private $user;

    /**
     * @ORM\Column(name="df",type="date")
     */
    private $df;

    /**
     * @return mixed
     */
    public function getDf()
    {
        return $this->df;
    }

    /**
     * @param mixed $df
     */
    public function setDf($df)
    {
        $this->df = $df;
    }

    /**
     * @return mixed
     */
    public function getDd()
    {
        return $this->dd;
    }

    /**
     * @param mixed $dd
     */
    public function setDd($dd)
    {
        $this->dd = $dd;
    }

    /**
     * @ORM\Column(name="dd",type="date")
     */
    private $dd;

    /**
     * Reservation constructor.
     * @param $livre
     * @param $user
     * @throws \Exception
     */
    public function __construct(Livre $livre)
    {$this->livre=$livre;
        $this->df = new \DateTime('now');
        $this->dd = new \DateTime('now') ;
        date_add($this->df, date_interval_create_from_date_string('3 days'));

    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * @return mixed
     */
    public function getLivre()
    {
        return $this->livre;
    }

    /**
     * @param mixed $livres
     */
    public function setLivre($livre)
    {
        $this->livre = $livre;
    }


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

