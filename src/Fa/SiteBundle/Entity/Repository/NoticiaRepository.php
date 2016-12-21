<?php

namespace Fa\SiteBundle\Entity\Repository;

/**
 * NoticiaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NoticiaRepository extends \Doctrine\ORM\EntityRepository
{
    
    public function listarTodos($limite = null){
        $qb = $this->createQueryBuilder('n')
                ->select('n')
                ->distinct()
                ->addOrderBy('n.dataCadastro', 'DESC');
        
        if(false == is_null($limite)){
            $qb->setMaxResults($limite);
        }
        
        return $qb->getQuery()->getResult();
        
    }
    
}
