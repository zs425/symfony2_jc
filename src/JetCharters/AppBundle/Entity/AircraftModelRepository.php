<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use JetCharters\AppBundle\Entity\OperatorUser;

/**
 * AircraftModelRepository
 */
class AircraftModelRepository extends EntityRepository
{
    public function findBySlug($slug) {
        return $this->_em->createQuery("SELECT m FROM JetChartersAppBundle:AircraftModel m WHERE m.slug = :slug")
            ->setParameter('slug', $slug)
            ->getSingleResult();
    }

    public function findByClass($class) {
        return $this->_em->createQuery("SELECT m FROM JetChartersAppBundle:AircraftModel m WHERE m.class = :class")
            ->setParameter('class', $class)
            ->getResult();
    }

    public function findByTypeSlug($slug) {
        die($slug);
        return $this->_em->createQuery("
            SELECT m
            FROM JetChartersAppBundle:AircraftModel m
            LEFT JOIN m.type t
            WHERE t.slug = :slug
            ")
            ->setParameter('slug', $slug)
            ->getResult();
    }
}
