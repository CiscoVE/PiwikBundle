<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: USER SETTINGS
 * Get the user settings
 */
class UserSettings extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'UserSettings' );
    }

    public function setQuery( $query )
    {
        $this->query = $this->request->ParseUrl( $this->name . $query );
    }

    /**
     * Get resolution
     *
     * @param string $segment
     */
    public function getResolution( $segment = '' )
    {
        $this->setQuery( 'getResolution' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get configuration
     *
     * @param string $segment
     */
    public function getConfiguration( $segment = '' )
    {
        $this->setQuery( 'getConfiguration' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get operating system
     *
     * @param string $segment
     * @param bool $addShortLabel
     */
    public function getOs( $segment = '', $addShortLabel = '1' )
    {
        $this->setQuery( 'getOS' );
        $this->setParameters( array(
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
    public function getOSFamily( $segment = '' )
    {
        $this->setQuery( 'getOSFamily' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get Mobile vs Desktop
     *
     * @param string $segment
     */
    public function getMobileVsDesktop( $segment = '' )
    {
        $this->setQuery( 'getMobileVsDesktop' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get browser version
     *
     * @param string $segment
     */
    public function getBrowserVersion( $segment = '' )
    {
        $this->setQuery( 'getBrowserVersion' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get browser
     *
     * @param string $segment
     */
    public function getBrowser( $segment = '' )
    {
        $this->setQuery( 'getBrowser' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get browser type
     *
     * @param string $segment
     */
    public function getBrowserType( $segment = '' )
    {
        $this->setQuery( 'getBrowserType' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get wide screen information
     *
     * @param string $segment
     */
    public function getWideScreen( $segment = '' )
    {
        $this->setQuery( 'getWideScreen' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get plugins
     *
     * @param string $segment
     */
    public function getUserPlugin( $segment = '' )
    {
        $this->setQuery( 'getPlugin' );
        $this->setParameters( array(
            'segment'       => $segment,
        ));

        return $this->execute();
    }
}