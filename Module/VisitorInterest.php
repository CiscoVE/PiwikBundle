<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: VISITOR INTEREST
 * Get the interests of the visitor
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
    public function getNumberOfVisitsPerDuration( $segment = '' )
    {
        $this->setQuery( 'getNumberOfVisitsPerVisitDuration' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the number of visits per visited page
     *
     * @param string $segment
     */
    public function getNumberOfVisitsPerPage( $segment = '' )
    {
        $this->setQuery( 'getNumberOfVisitsPerPage' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the number of days elapsed since the last visit
     *
     * @param string $segment
     */
    public function getNumberOfVisitsByDaySinceLast( $segment = '' )
    {
        $this->setQuery( 'getNumberOfVisitsByDaysSinceLast' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the number of visits by visit count
     *
     * @param string $segment
     */
    public function getNumberOfVisitsByCount( $segment = '' )
    {
        $this->setQuery( 'getNumberOfVisitsByVisitCount' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }
}