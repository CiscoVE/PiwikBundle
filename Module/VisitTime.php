<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: VISIT TIME
 * Get visit time
 */
class VisitTime extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'VisitTime' );
    }

    public function setQuery( $string )
    {
        $this->query = $this->name . $string;
    }

    /**
     * Get the visit by local time
     *
     * @param string $segment
     */
    public function getVisitLocalTime( $segment = '' )
    {
        $this->setQuery('getVisitInformationPerLocalTime' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the visit by server time
     *
     * @param string $segment
     * @param boolean $hideFutureHoursWhenToday Hide the future hours when the report is created for today
     */
    public function getVisitServerTime( $segment = '', $hideFutureHoursWhenToday = '' )
    {
        $this->setQuery( 'getVisitInformationPerServerTime' );
        $this->setParameters( array(
            'segment' => $segment,
            'hideFutureHoursWhenToday' => $hideFutureHoursWhenToday
        ));

        return $this->execute();
    }

    /**
     * Get the visit by server time
     *
     * @param string $segment
     */
    public function getByDayOfWeek( $segment = '' )
    {
        $this->setQuery( 'getByDayOfWeek' );
        $this->setParameters( array(
            'segment' => $segment,
        ));

        return $this->execute();
    }
}