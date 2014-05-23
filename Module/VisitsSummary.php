<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Model\Client;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: VISITS SUMMARY
 *
 * VisitsSummary API lets you access the core web analytics metrics (visits,
 * unique visitors, count of actions (page views & downloads & clicks on
 * outlinks), time on site, bounces and converted visits.
 */
class VisitsSummary extends Base
{

    /**
     * Get a visit summary
     *
     * @param string $segment
     * @param string $columns
     */
    public function __construct( Client $client )
    {
        parent::__construct( $client );
    }

    public function get( $segment = '', $columns = '' )
    {
        $this->setQuery( 'get' );
        $this->setParameters( array(
            'segment'   => $segment,
            'columns'   => $columns,
        ));

        return $this->execute();
    }


    /**
     * Get visits
     *
     * @param string $segment
     */
    public function getVisits( $segment = '' )
    {
        $this->setQuery( 'getVisits' );
        $this->setParameters( array(
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get unique visits
     *
     * @param string $segment
     */
    public function getUniqueVisitors( $segment = '' )
    {
        $this->setQuery( 'getUniqueVisitors' );
        $this->setParameters( array(
            'segment'   => $segment
        ));

        return $this->execute();
    }

    /**
     * Get actions
     *
     * @param string $segment
     */
    public function getActions( $segment = '' )
    {
        $this->setQuery( 'getActions' );
        $this->setParameters( array(
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get max actions
     *
     * @param string $segment
     */
    public function getMaxActions( $segment = '' )
    {
        $this->setQuery( 'getMaxActions' );
        $this->setParameters( array(
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get bounce count
     *
     * @param string $segment
     */
    public function getBounceCount( $segment = '' )
    {
        $this->setQuery( 'getBounceCount' );
        $this->setParameters( array(
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get converted visits
     *
     * @param string $segment
     */
    public function getVisitsConverted( $segment = '' )
    {
        $this->setQuery( 'getVisitsConverted' );
        $this->setParameters( array(
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the sum of all visit lengths
     *
     * @param string $segment
     */
    public function getSumVisitsLength( $segment = '' )
    {
        $this->setQuery( 'getSumVisitsLength' );
        $this->setParameters( array(
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the sum of all visit lengths formated in the current language
     *
     * @param string $segment
     */
    public function getSumVisitsLengthPretty( $segment = '' )
    {
        $this->setQuery( 'getSumVisitsLengthPretty' );
        $this->setParameters( array(
            'segment'   => $segment,
        ));

        return $this->execute();
    }
}