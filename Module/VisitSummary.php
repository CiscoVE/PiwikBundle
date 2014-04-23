<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;
/**
 * MODULE: VISITS SUMMARY
 * Get visit summary information
 */
class VisitSummary extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'VisitsSummary' );
    }

    /**
     * Get a visit summary
     *
     * @param string $segment
     * @param string $columns
     */
    public function getVisitsSummary( $segment = '', $columns = '' )
    {
        $this->setQuery( 'get' );
        $this->setParameters( array(
            'segment' => $segment,
            'columns' => $columns,
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
            'segment' => $segment,
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
            'segment' => $segment
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
            'segment' => $segment,
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
            'segment' => $segment,
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
            'segment' => $segment,
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
            'segment' => $segment,
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
            'segment' => $segment,
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
            'segment' => $segment,
        ));

        return $this->execute();
    }
}