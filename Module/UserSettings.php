<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: USER SETTINGS
 *
 * The UserSettings API lets you access reports about your Visitors technical
 * settings: browsers, browser types (rendering engine), operating systems,
 * plugins supported in their browser, Screen resolution and Screen types
 * (normal, widescreen, dual screen or mobile).
 */
class UserSettings extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'UserSettings' );
    }

    /**
     * Get resolution
     *
     * @param string $segment
     */
    public function getResolution( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getResolution' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get configuration
     *
     * @param string $segment
     */
    public function getConfiguration( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getConfiguration' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get operating system
     *
     * @param string $segment
     * @param bool $addShortLabel
     */
    public function getOs( $idSite, $period, $date, $segment = '', $addShortLabel = '1' )
    {
        $this->setQuery( 'getOS' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
            'addShortLabel' => $addShortLabel,
        ));

        return $this->execute();
    }

    /**
     * Get operating system family
     *
     * @param string $segment
     */
    public function getOSFamily( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getOSFamily' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get Mobile vs Desktop
     *
     * @param string $segment
     */
    public function getMobileVsDesktop( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getMobileVsDesktop' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get browser version
     *
     * @param string $segment
     */
    public function getBrowserVersion( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getBrowserVersion' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get browser
     *
     * @param string $segment
     */
    public function getBrowser( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getBrowser' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get browser type
     *
     * @param string $segment
     */
    public function getBrowserType( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getBrowserType' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get wide screen information
     *
     * @param string $segment
     */
    public function getWideScreen( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getWideScreen' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get plugins
     *
     * @param string $segment
     */
    public function getPlugin( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getPlugin' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get Language
     *
     * @param string $segment
     */
    public function getLanguage( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getLanguage' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    public function setQuery( $query )
    {
        $this->query = $this->request->ParseUrl( $this->name . $query );
    }
}