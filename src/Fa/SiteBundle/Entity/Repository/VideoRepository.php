<?php

namespace Fa\SiteBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * VideoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class VideoRepository extends EntityRepository
{
    
    public function listarTodos($limite = null){
        $qb = $this->createQueryBuilder('v')
                ->select('v')
                ->distinct()
                ->addOrderBy('v.dataCadastro', 'DESC');
        
        if(false == is_null($limite)){
            $qb->setMaxResults($limite);
        }
        
        return $qb->getQuery()->getResult();
        
    }
    
}
