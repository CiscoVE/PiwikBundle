<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: VISITOR INTEREST
 *
 * VisitorInterest API lets you access two Visitor Engagement reports: number
 * of visits per number of pages, and number of visits per visit duration.
 */
class VisitorInterest extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'VisitorInterest' );
    }

    /**
     * Get the number of visits per visit duration
     *
     * @param string $segment
     */
    public function getNumberOfVisitsPerDuration( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getNumberOfVisitsPerVisitDuration' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the number of visits per visited page
     *
     * @param string $segment
     */
    public function getNumberOfVisitsPerPage( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getNumberOfVisitsPerPage' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the number of days elapsed since the last visit
     *
     * @param string $segment
     */
    public function getNumberOfVisitsByDaySinceLast( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getNumberOfVisitsByDaysSinceLast' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the number of visits by visit count
     *
     * @param string $segment
     */
    public function getNumberOfVisitsByCount( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getNumberOfVisitsByVisitCount' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }
}