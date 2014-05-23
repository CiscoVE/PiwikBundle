<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Model\Piwik;
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
    public function __construct( Piwik $piwik )
    {
        parent::__construct( $piwik, 'VisitsSummary' );
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
    public function getActions( $idSite, $period, $date, $segment = '' )
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
    public function getMaxActions( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getMaxActions' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get bounce count
     *
     * @param string $segment
     */
    public function getBounceCount( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getBounceCount' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get converted visits
     *
     * @param string $segment
     */
    public function getVisitsConverted( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getVisitsConverted' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the sum of all visit lengths
     *
     * @param string $segment
     */
    public function getSumVisitsLength( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getSumVisitsLength' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the sum of all visit lengths formated in the current language
     *
     * @param string $segment
     */
    public function getSumVisitsLengthPretty( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getSumVisitsLengthPretty' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }
}