<?php
	// src/AppBundle/Entity/User.php

	namespace AppBundle\Entity {

        use FOS\UserBundle\Model\User as BaseUser;
        use Doctrine\ORM\Mapping as ORM;

        /**
         * @ORM\Entity
         * @ORM\Table(name="user")
         * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateursRepositiory")
         */
        class User extends BaseUser
        {
            /**
             * @ORM\Id
             * @ORM\Column(type="integer")
             * @ORM\GeneratedValue(strategy="AUTO")
             */
            protected $id;

            /**
             * @ORM\Column(type="string", length=255 , nullable=true)
             */
            protected $nom;

            /**
             * @ORM\ManyToOne(targetEntity="ClassesBundle\Entity\Classe")
             * @ORM\JoinColumn(name="classe_id",referencedColumnName="id")
             */
            protected $classe;
            /**
             * @ORM\Column(type="string" , length=255 , nullable=true)
             */
            protected $prenom;

            public function __construct()
            {$this->nom='def';
            $this->prenom='def';
                parent::__construct();
                // your own logic
            }


            /**
             * Set nom
             *
             * @param string $nom
             *
             * @return User
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
             * Set prenom
             *
             * @param string $prenom
             *
             * @return User
             */
            public function setPrenom($prenom)
            {
                $this->prenom = $prenom;

                return $this;
            }

            /**
             * Get prenom
             *
             * @return string
             */
            public function getPrenom()
            {
                return $this->prenom;
            }


            /**
             * Set classe
             *
             * @param \ClassesBundle\Entity\Classe $classe
             *
             * @return User
             */
            public
            function setClasse(\ClassesBundle\Entity\Classe $classe = null)
            {
                $this->classe = $classe;

                return $this;
            }

            /**
             * Get classe
             *
             * @return \AppBundle\Entity\Classe
             */
            public
            function getClasse()
            {
                return $this->classe;
            }


        }

}
