<?php


namespace AppBundle\Repository;


class UtilisateursRepositiory extends \Doctrine\ORM\EntityRepository
{
    public function findEtudiants()
    {
        $query=$this->getEntityManager()->createQuery("SELECT u FROM AppBundle:User u
WHERE u.roles like '%ROLE_ETUDIANT%'");
        return $query->getResult();
    }

}