<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: USER COUNTRY
 *
 * The UserCountry API lets you access reports about your visitors'
 * Countries and Continents.
 */
class UserCountry extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'UserCountry' );
    }

    /**
     * Get countries of all visitors
     *
     * @param string $segment
     */
    public function getCountry( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getCountry' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get continents of all visitors
     *
     * @param string $segment
     */
    public function getContinent( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getContinent' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get regions of all visitors
     *
     * @param string $segment
     */
    public function getRegion( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getRegion' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get cities of all visitors
     *
     * @param string $segment
     */
    public function getCity( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getCity' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    public function getLocation( $ip, $provider = '' )
    {
        $this->setQuery( 'getCity' );
        $this->setParameters( array(
            'ip'        => $ip,
            'provider'  => $provider,
        ));

        return $this->execute();
    }

    /**
     * Get the number of disting countries
     *
     * @param string $segment
     */
    public function getCountryNumber( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getNumberOfDistinctCountries' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }
}