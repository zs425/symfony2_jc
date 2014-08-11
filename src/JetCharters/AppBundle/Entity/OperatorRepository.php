<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * OperatorRepository
 */
class OperatorRepository extends EntityRepository
{
    public function findBySlugForDetail($slug) {
        return $this->_em
            ->createQuery("SELECT o, a, l, m, i, t, lo, org, d
                FROM JetChartersAppBundle:Operator o
                LEFT JOIN o.aircraft a
                LEFT JOIN o.emptylegs l
                LEFT JOIN a.model m
                LEFT JOIN a.images i
                LEFT JOIN m.type t
                LEFT JOIN a.location lo
                LEFT JOIN l.origin org
                LEFT JOIN l.destination d
                WHERE o.slug = :slug")
            ->setParameter('slug', $slug)
            ->getSingleResult();
    }
    
    public function findSimilarOperators($lat, $lang, $operatorId)
    {
    
		if ($lat!='' && $lang!='' &&  $operatorId>0) {
			$sql = 
			"SELECT *, ( 3959 * acos( cos( radians(".$lat.") ) * cos( radians( n_latitude ) ) * 
			cos( radians( n_longitude ) - radians(".$lang.") ) + sin( radians(".$lat.") ) * 
			sin( radians( n_latitude ) ) ) ) AS distance 
			FROM operators 
			WHERE id!='".$operatorId."'
			HAVING distance <= 100	 
			ORDER BY distance 
			LIMIT 0 , 40"
			;
			
			$stmt = $this->getEntityManager()->getConnection()->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}
    }
}
