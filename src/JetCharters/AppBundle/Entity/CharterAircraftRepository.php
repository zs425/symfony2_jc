<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use JetCharters\AppBundle\Entity\OperatorUser;
use Doctrine\ORM\Query\Expr;

/**
 * CharterAircraftRepository
 */
class CharterAircraftRepository extends EntityRepository
{
    public function findByOperator($id, OperatorUser $user) {
	    $company = $user->getOperator();

	    return $this->findOneBy(array('id' => $id, 'operator' => $company));
    }

    public function findAllByOperator(OperatorUser $user) {
	    $company = $user->getOperator();

	    return $this->findBy(array('operator' => $company));
    }

    public function findByModel(AircraftModel $model) {
        return $this->findBy(array('model' => $model));
    }

    public function findByModelTypeSlug($slug) {

    }

    public function findAllAirAmbulances() {
    
        return $this->getEntityManager()
            ->createQuery('SELECT a, o, l, i, m
                            FROM JetChartersAppBundle:CharterAircraft a
                            LEFT JOIN a.operator o
                            LEFT JOIN a.images i
                            LEFT JOIN a.location l
                            LEFT JOIN a.model m
                            WHERE a.airAmbulance = 1')
            ->getResult();
    }

    public function findFeaturedAircraft( $country_code, $state, $city) {
    
        $sql = $this->getEntityManager()->createQueryBuilder()
        	->select('a', 'i', 'l', 'm')
        	->from('JetChartersAppBundle:CharterAircraft', 'a')	
        	->leftjoin('a.images', 'i')
        	->leftjoin('a.location', 'l')
        	->leftjoin('a.model', 'm');       	

            if ($country_code !='' ){            	
            	$sql = $sql->where('l.countryCode = :country_code')->setParameter('country_code', $country_code);            	
            }
            if($state !='' && $state != 'not found' ){
            	$sql = $sql->andWhere('l.state = :state')->setParameter('state', $state); 
            }
            if($city !='' && $city != 'not found'){
            	$sql = $sql->andWhere('l.city = :city')->setParameter('city', $city);
            }

            if ($country_code == '' && $state =='not found' && $city =='not found'){
            	$sql = $sql->setMaxResults(10);
            }

        return  $sql->getQuery()->execute();
    }
    
    public function findCharterAircraftDetail($operatorSlug, $aircraftModelSlug, $tail) {
    
	if ($operatorSlug!='' && $aircraftModelSlug!='' &&  $tail!='') {
	    
	    $curDate = date('Y-m-d H:i:s');
	    return $this->getEntityManager()->createQueryBuilder()
		->select('a', 'o', 'i', 'l','m', 't', 'e', 'org', 'd')
		->from('JetChartersAppBundle:CharterAircraft', 'a')
		->leftjoin('a.operator', 'o')
		->leftjoin('a.images', 'i')
		->leftjoin('a.location', 'l')
		->leftjoin('a.model', 'm')
		->leftjoin('m.type', 't')
		->leftjoin('a.emptylegs', 'e', Expr\Join::WITH, 'e.fromDate >= \''.$curDate.'\' ')
		->leftjoin('e.origin', 'org')
		->leftjoin('e.destination', 'd')
		->where('o.slug = :operatorSlug')->setParameter('operatorSlug', $operatorSlug)
		->andWhere('m.slug = :modelSlug')->setParameter('modelSlug', $aircraftModelSlug)
		->andWhere('a.tailNumber = :tailNumber')->setParameter('tailNumber', $tail)
		->getQuery()->execute();
	}
        
    }
    
    public function findSimilartAircraft($aircraftModelTypeId, $aircraftId) {
    
	if ($aircraftModelTypeId!='') {
	    
	    return $this->getEntityManager()->createQueryBuilder()
		->select('a', 'i', 'm', 'o', 't')
		->from('JetChartersAppBundle:CharterAircraft', 'a')
		->leftjoin('a.images', 'i')
		->leftjoin('a.model', 'm')
		->leftjoin('a.operator', 'o')
		->leftjoin('m.type', 't')
		->where('t.id = :typeId')->setParameter('typeId', $aircraftModelTypeId)
		->andWhere('a.id != :id')->setParameter('id', $aircraftId)
		->groupBy('a.id')
		->setMaxResults(8)
		->getQuery()->execute();
	}
        
    }

    public function findByType($airport_type, $city, $radius) {

        $sql = $this->getEntityManager()->createQueryBuilder()
            ->select( 'a', 'm', 'i', 'o', 'e', 'k' )
            ->from('JetChartersAppBundle:CharterAircraft', 'a')
            ->leftjoin('a.images', 'i')
            ->leftjoin('a.model', 'm')
            ->leftjoin('a.location', 'k')
            ->leftjoin('a.operator', 'o')
            ->leftjoin('a.emptylegs', 'e')
            ->leftjoin('m.type', 't')

            ;


        if ($airport_type !='' ){
            $sql = $sql->where('t.id = :airport_type_id')->setParameter('airport_type_id', $airport_type);
        }
        if(!empty($city)){
            $sql = $sql->andWhere('k.closestCity IN (:closest_city)')->setParameter('closest_city', $city);
        }
        if($radius !=''){
            $sql = $sql->andWhere('k.closestCityDistanceMiles <= :radius')->setParameter('radius', $radius);
        }
        if($airport_type =='' && empty($city) && $radius ==''){
            $sql = $sql->setMaxResults(20);
        }

        return  $sql->getQuery()->execute();

    }
}
