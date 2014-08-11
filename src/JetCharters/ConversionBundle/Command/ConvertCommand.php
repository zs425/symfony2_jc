<?php

namespace JetCharters\ConversionBundle\Command;

use Doctrine\DBAL\DBALException;
use JetCharters\AppBundle\Entity\AircraftModel;
use JetCharters\AppBundle\Entity\AircraftModelImage;
use JetCharters\AppBundle\Entity\AircraftType;
use JetCharters\AppBundle\Entity\Airport;
use JetCharters\AppBundle\Entity\CharterAircraft;
use JetCharters\AppBundle\Entity\CharterAircraftEmptyLeg;
use JetCharters\AppBundle\Entity\CharterAircraftImage;
use JetCharters\AppBundle\Entity\EmptyLeg;
use JetCharters\AppBundle\Entity\Operator;
use JetCharters\AppBundle\Entity\OperatorUser;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertCommand extends ContainerAwareCommand
{
    private $dbh_old;

    protected function configure()
    {
        $this
            ->setName('jetcharters:convert-data')
            ->setDescription('Convert Data from old database ')
            ->addArgument('table', InputArgument::REQUIRED, 'Which table to import from')
            ->addOption('username', null, InputOption::VALUE_OPTIONAL, 'Source Database Username')
            ->addOption('password', null, InputOption::VALUE_OPTIONAL, 'Source Database Password')
            ->addOption('airports', null, InputOption::VALUE_NONE, 'Import');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = $input->getArgument('table');

        $this->dbh_old = new \PDO(sprintf('mysql:host=mysql55a.ayera.com;dbname=%s', $table), $input->getOption('username'), $input->getOption('password'));

        $this->importAircraftTypes();
//        $this->importAirports();
        $this->importOperators();

    }

    private function importAirports()
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $idx = 0;
        foreach ($this->dbh_old->query("SELECT distinct * FROM ejairports o") as $row) {
            $airport = new Airport();
            $airport->setLfiCode($row['LFI']);
            $airport->setType($row['LFT']);
            $airport->setIcaoCode($row['ICAO']);
            $airport->setIataCode($row['IATA']);
            $airport->setFaaCode($row['FAA_CODE']);
            $airport->setName($row['AIRPORT_NAME']);
            $airport->setCity($row['CITY_NAME']);
            $airport->setState($row['STATE_NAME']);
            $airport->setCountryCode($row['COUNTRY_CODE']);
            $airport->setLatitude($row['LATITUDE']);
            $airport->setLongitude($row['LONGITUDE']);
            $airport->setElevation($row['ELEVATION']);
            $airport->setOperatingHours($row['OPR_HOURS']);
            $airport->setUtcConversion($row['UTC_STD_CONVERSION']);
            $airport->setClosestCity($row['CLOSEST_CITY']);
            $airport->setClosestCityDistanceMiles(empty($row['CLOSEST_CITY_DIST_MILES']) ? 0 : $row['CLOSEST_CITY_DIST_MILES']);
            $airport->setClosestCityDistanceKm(empty($row['CLOSEST_CITY_DIST_KM']) ? 0 : $row['CLOSEST_CITY_DIST_KM']);
            $airport->setCentralBusinessDirection($row['CENTRAL_BUSINESS_DIRECTION']);
            $airport->setMaxRunway(empty($row['MaxRunway']) ? 0 : $row['MaxRunway']);
            $airport->setNLatitude($row['NLATITUDE']);
            $airport->setNLongitude($row['NLONGITUDE']);

            $em->persist($airport);

            if (($idx++ % 1000) == 0) {
                $em->flush();
                $em->clear();
            }
        }
        $em->flush();
        $em->clear();
    }

    private function importAircraftTypes()
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        foreach ($this->dbh_old->query("SELECT * FROM ejcharteraircraftsizes a") as $row) {
            $t = new AircraftType();
            $t->setName(ucwords($row['sizeName']));
            $t->setSlug($row['sizeName']);
            $t->setClass($row['aircraftClassNumber']);
            echo sprintf("Saving %s\n", $row['sizeName']);
            $em->persist($t);
        }
        $em->flush();

        $aircraft_path = $this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/aircraft/';

//        foreach ($this->dbh_old->query("SELECT * FROM ejaircraft a") as $row) {
        foreach ($this->dbh_old->query("Select Distinct ca.name, ca.type, a.seats, a.ASPD, a.Range, a.Description, a.FeaturedACRank, a.FeaturedAC, a.altName, a.Lavatory, a.pic1, a.pic2, a.pic3, a.pic4, a.pic5 from ejcharteraircraft ca left join ejaircraft a on (a.Name = ca.name)  group by name") as $row) {
            echo sprintf("Working %s\n", $row['name']);
            $a = new AircraftModel();
            $a->setName($row['name']);
            $a->setType($em->getRepository('JetChartersAppBundle:AircraftType')->findOneByName($row['type']));
            $a->setHasLavatory($row['Lavatory'] == 'Y' ? true : false);
            $a->setNumberOfSeats(empty($row['seats']) ? 0 : $row['seats']);
            $a->setMaxRange(empty($row['Range']) ? 0 : $row['Range']);
            $a->setMaxAirSpeed(empty($row['ASPD']) ? 0 : $row['ASPD']);
            $a->setDescription(empty($row['Description']) ? $row['name'] : $row['Description']);
            $a->setFeaturedACRank(empty($row['FeaturedACRank']) ? 0 : $row['FeaturedACRank']);
            $a->setIsFeaturedAC($row['FeaturedAC'] == 1 ? true : false);
            $a->setAlternateNames($row['altName']);
            $a->updateSlug();

            for ($i = 1; $i < 6; $i++) {
                if (!empty($row['pic' . $i])) {
                    if ($data = file_get_contents('http://cdn.jetcharters.com' . $row['pic' . $i])) {

                        $name = $a->getSlug() . '-' . $i . '.jpg';

                        file_put_contents($aircraft_path . $name, $data);

                        $image = new AircraftModelImage();
                        $image->setImageName($name);
                        $a->addImage($image);
                    }
                }
            }


            echo sprintf("Saving %s\n", $row['name']);
            $em->persist($a);
        }

        $em->flush();
    }

    private function importOperators()
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $idx = 0;
        foreach ($this->dbh_old->query("
                    SELECT *
                    FROM ejcharteroperators o

                    ") as $row) {
            echo sprintf("Working %s\n", $row['company']);
            $operator = new Operator();
            $operator->setName($row['company']);
            $operator->setAddress1($row['address']);
            $operator->setAddress1($row['address2']);
            $operator->setCity($row['city']);
            $operator->setState($row['state']);
            $operator->setZipcode($row['zip']);
            $operator->setCountry($row['country']);
            $operator->setContactName($row['firstName'] . ' ' . $row['lastName']);
            $operator->setContactPhone($row['phone']);
            $operator->setWebsite($row['website']);
            $operator->setFacebookUrl($row['socialFacebook']);
            $operator->setTwitterUrl($row['socialTwitter']);
            $operator->setLinkedinUrl($row['socialLinkedIn']);
            $operator->setAbout($row['about']);
            $operator->setShowACSFLogo(in_array($row['safetyAcsf'], array('yes', 'true')) ? true : false);
            $operator->setShowISBAOLogo(in_array($row['safetyIsBao'], array('yes', 'true')) ? true : false);
            $operator->setEmailVerified(in_array($row['emailVerified'], array('yes', 'true')) ? true : false);
            $operator->setSendInvoice(in_array($row['sendInvoice'], array('yes', 'true')) ? true : false);
            $operator->setCertificateNumber($row['certificateNumber']);
            $operator->setShowWyvernLogo(in_array($row['safetyWyvern'], array('yes', 'true')) ? true : false);
            $operator->setShowArgusLogo(in_array($row['safetyArgus'], array('yes', 'true')) ? true : false);
            $operator->setIsActive(in_array($row['status'], array('active')) ? true : false);
            $operator->setMarketingNumber($row['callfireNumber']);
            $operator->setCallRecording($row['callRecordingEnabled'] == 'yes' ? true : false);
//            $operator->setMarketingForwardNumber($row['callNumber']);
            $operator->setBillingAccountCost(empty($row['accountCost']) ? 0 : $row['accountCost']);
            $operator->setBillingAirplaneCost($row['airplaneCost']);
            $operator->setBillingAirplaneCost2($row['airplaneCost2']);
            $operator->setBillingAirplaneCost3($row['airplaneCost3']);
            $operator->setBillingAirplaneCost4($row['airplaneCost4']);
            $operator->setBillingAirplaneCost5($row['airplaneCost5']);
            $operator->setBillingAirplaneCost6($row['airplaneCost6']);
            $operator->setBillingAirplaneCost7($row['airplaneCost7']);
            $operator->setBillingAutoRenew($row['billingAutoRenew'] == 'true' ? true : false);
            $operator->setBillingCycle(empty($row['billingCycle']) ? 'monthly' : $row['billingCycle']);
            $operator->setBillingNextDue(new \DateTime($row['nextBillingDate']));

            if (!empty($row['logo'])) {
                if ($imgdata = file_get_contents('http://cdn.jetcharters.com/images/capics/' . $row['logo'])) {
                    file_put_contents($this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/operator/' . $row['logo'], $imgdata);
                    $operator->setLogoName($row['logo']);
                }
            }

            if (!($user = $em->getRepository('JetChartersAppBundle:OperatorUser')->findOneByEmail($row['email']))) {

                $user = new OperatorUser();
                $user->setFirstName($row['firstName']);
                $user->setLastName($row['lastName']);
                $user->setEmail($row['email']);
                $user->setPhone($row['phone']);
                $user->setPosition($row['position']);
                $user->setUsername($row['email']);
                $user->setPlainPassword($row['password']);
                $user->setEnabled(true);
            }
            $operator->addUser($user);

            // billing user
            if ($row['email'] == $row['billingEmail']) {

            } elseif (($row['firstName'] != $row['billingFirstName'] && $row['lastName'] != $row['billingLastName'] && !empty($row['billingFirstName'])) ||
                ($row['firstName'] != $row['billingFirstName'] && $row['lastName'] == $row['billingLastName'])
            ) {


                if (!($user = $em->getRepository('JetChartersAppBundle:OperatorUser')->findOneByEmail($row['email']))) {
                    $user = new OperatorUser();
                    $user->setFirstName($row['billingFirstName']);
                    $user->setLastName($row['billingLastName']);
                    if ($row['email'] == $row['billingEmail']) {
                        $user->setEmail($row['email'] . 'dupe');
                    } else {
                        $user->setEmail(empty($row['billingEmail']) ? ($row['email'] . "-fix") : $row['billingEmail']);
                    }
                    $user->setAddress1($row['billingAddress']);
                    $user->setAddress2($row['billingAddress2']);
                    $user->setCity($row['billingCity']);
                    $user->setState($row['billingState']);
                    $user->setZip($row['billingZipCode']);
                    $user->setUsername(empty($row['billingEmail']) ? ($row['billingFirstName'] . '.' . $row['billingLastName']) : $row['billingEmail']);
                    $user->setPlainPassword($row['password']);
                    $user->setEnabled(true);
                }
                $operator->addUser($user);
            }
            $operator->setBillingUser($user);


            /** Import charter aircrafts */
            foreach ($this->dbh_old->query(sprintf("SELECT * FROM ejcharteraircraft a WHERE a.charterOperatorID = '%s'", $row['ID'])) as $charter) {
                echo sprintf(".. Working %s\n", $charter['name']);
                $ca = new CharterAircraft();
                $ca->setName($charter['name']);
                $ca->setLocation($em->getRepository('JetChartersAppBundle:Airport')->findOneBy(array('icaoCode' => $charter['location'])));
                $ca->setModel($em->getRepository('JetChartersAppBundle:AircraftModel')->findOneBy(array('name' => $charter['name'])));
                $ca->setActive($charter['status'] == 'active' ? true : false);
                $ca->setAirAmbulance($charter['airAmbulance'] == 'yes' ? true : false);
                $ca->setTailNumber($charter['tailNumber']);
                $ca->setRealTailNumber($charter['realTailNumber']);
                $ca->setHideTailNumber($charter['hideTailNumber'] = 'yes' ? true : false);
                $ca->setHourlyRate($charter['hourlyRate']);
                $ca->setHourlyRate2($charter['hourlyRate2']);
                $ca->setSeats($charter['seats']);
                $operator->addAircraft($ca);

                /** Import empty legs */
                foreach ($this->dbh_old->query(sprintf("SELECT * FROM ejairmailoperators o WHERE o.charterAircraftID = '%s'", $charter['ID'])) as $emptyleg) {
                    $el = new CharterAircraftEmptyLeg();
                    $el->setFromDate(new \DateTime($emptyleg['FromDate']));
                    $el->setToDate(new \DateTime($emptyleg['ToDate']));
                    if ( $origin = $em->getRepository('\JetCharters\AppBundle\Entity\Airport')->findOneByIcaoCode($emptyleg['Origin']) ) {
                        $el->setOrigin($origin);
                    }

                    if ( $destination = $em->getRepository('\JetCharters\AppBundle\Entity\Airport')->findOneByIcaoCode($emptyleg['Destination']) ) {
                        $el->setDestination($destination);
                    }


                    $ca->addEmptyleg($el);
                    $operator->addEmptyleg($el);
                }

                $image_path = $path = $this->getContainer()->get('kernel')->getRootDir() . '/../web/uploads/charter/';

                for ($i = 1; $i < 6; $i++) {
                    if (!empty($charter['pic' . $i])) {
                        if ($data = @file_get_contents('http://cdn.jetcharters.com/images/capics/' . $charter['pic' . $i])) {

                            $name = $charter['pic' . $i];

                            file_put_contents($image_path . $name, $data);

                            $image = new CharterAircraftImage();
                            $image->setImageName($name);
                            $ca->addImage($image);
                        }
                    }
                }
            }


            echo sprintf("Saving\n");
            try {
                $em->persist($operator);
                //            if ( ($idx++ % 100) == 0 ) {
                $em->flush();
                $em->clear();
//            }
            } catch (DBALException $e) {
                echo sprintf("!!!ERROR!!!  %s", $e->getMessage());
            }

        }


        $em->flush();
        $em->clear();

    }

    private function findAircraftModel($name)
    {
        $this->getContainer()->get('doctrine')->getManager()->createQuery('
            SELECT a
            FROM JetChartersAppBundle:AircraftModel a
            WHERE a.name = :exact
            OR a.alternateNames LIKE :search
        ')
            ->setParameter('exact', $name)
            ->setParameter('search', "%{$name}%")
            ->getResult();

    }
}