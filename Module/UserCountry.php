<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: USER COUNTRY
 * Get visitors country information
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
    public function getCountry( $segment = '' )
    {
        $this->setQuery( 'getCountry' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get continents of all visitors
     *
     * @param string $segment
     */
    public function getContinent( $segment = '' )
    {
        $this->setQuery( 'getContinent' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get regions of all visitors
     *
     * @param string $segment
     */
    public function getRegion( $segment = '' )
    {
        $this->setQuery( 'getRegion' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get cities of all visitors
     *
     * @param string $segment
     */
    public function getCity( $segment = '' )
    {
        $this->setQuery( 'getCity' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the number of disting countries
     *
     * @param string $segment
     */
    public function getCountryNumber( $segment = '' )
    {
        $this->setQuery( 'getNumberOfDistinctCountries' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }
}