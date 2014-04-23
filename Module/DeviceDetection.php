<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: Devices Detection
 *
 * The DevicesDetection API lets you access reports on your visitors devices,
 * brands, models, Operating system, Browsers.
 */
class DeviceDetection extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'DevicesDetection' );
    }

    public function getType( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getType' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    public function getBrand( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getBrand' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    public function getModel( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getModel' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    public function getOsFamilies( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getOsFamilies' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    public function getOsVersions( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getOsVersions' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    public function getBrowserFamilies( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getBrowserFamilies' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    public function getBrowserVersions( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getBrowserVersions' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }
}