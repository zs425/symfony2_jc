<?php

namespace JetCharters\AppBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Matt Drollette <matt@drollette.com>
 */
class LocaleExtension extends \Twig_Extension
{
    protected $container;
    protected $timezone;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->timezone = $this->container->get('session')->get('timezone', 'UTC');
        //$this->timezone = 'UTC';

    }

    public function getFunctions()
    {
        return array();
    }

    public function getFilters()
    {
        return array(
            'datetime' => new \Twig_Filter_Method($this, 'formatDatetime', array('is_safe' => array('html'))),
            'cleanurl' => new \Twig_Filter_Method($this, 'formatCleanurl'),
            'formalText' => new \Twig_Filter_Method($this, 'formatFormalText'),
            'ucwords' => new \Twig_Filter_Method($this, 'formatUcWords')

        );
    }


    public function formatUcWords($string) {
        return ucwords($string);
    }

    public function formatCleanurl($string)
    {
        if ($string != '') {
            return $string = strtolower(str_replace(' ', '-', str_replace("/", "-", $string))); // Replaces all spaces with hyphens.
        }

        //return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
    }

    public function formatFormalText($string)
    {
        if ($string != '') {
            return $string = ucwords(strtolower($string)); 
        }

        //return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
    }

    public function formatDatetime($date, $format, $timezone = null)
    {
        if (null === $timezone) {
            $timezone = $this->timezone;
        }

        if (!$date instanceof \DateTime) {
            if (ctype_digit((string)$date)) {
                $date = new \DateTime('@' . $date, new \DateTimeZone("UTC"));
            } else {
                $date = new \DateTime($date, new \DateTimeZone("UTC"));
            }
        }

        if (!$timezone instanceof \DateTimeZone) {
            $timezone = new \DateTimeZone($timezone);
        }

        $date->setTimezone($timezone);


        return $date->format($format);
    }

    public function getName()
    {
        return 'core_locale';
    }
}