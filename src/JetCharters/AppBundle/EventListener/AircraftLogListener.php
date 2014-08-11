<?php

namespace JetCharters\AppBundle\EventListener;

use JetCharters\AppBundle\Entity\CharterAircraft;
use JetCharters\AppBundle\Entity\AircraftStatusLog;
use Doctrine\ORM\Event\LifecycleEventArgs;


class AircraftLogListener
{

    private function createLogEntry (CharterAircraft $aircraft, LifecycleEventArgs $event) {
         
		 if ($event->getEntity() instanceof CharterAircraft) {

            // Create log of aircraft changes
            $log = new AircraftStatusLog();

            $log->setStatus($aircraft->getActive() ? 'Enabled' : 'Disabled');
            $log->setAircraft($aircraft);

            $log->setTimestamp(new \DateTime());

            $log->setStateInfo(array(   "company" => $aircraft->getCompanyName(),
                                        "name" => $aircraft->getName(),
                                        "tailnum" => $aircraft->getTailnumber()
                                        ));
            return $log;
        }
    }

    public function postPersist(CharterAircraft $aircraft, LifecycleEventArgs $event)
    {
        $log = $this->createLogEntry($aircraft, $event);
        $em = $event->getEntityManager();

        $em->persist($log);
        $em->flush($log);
    }

    public function postUpdate(CharterAircraft $aircraft, LifecycleEventArgs $event)
    {
        $log = $this->createLogEntry($aircraft, $event);
        $em = $event->getEntityManager();

        $em->persist($log);
        $em->flush($log);
    }

    public function preRemove(CharterAircraft $aircraft, LifecycleEventArgs $event)
    {
        $log = $this->createLogEntry($aircraft, $event);
        $log->setStatus("Deleted");
        $em = $event->getEntityManager();

        $em->persist($log);
        $em->flush($log);
    }

}