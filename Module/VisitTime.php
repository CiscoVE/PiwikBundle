<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: VISIT TIME
 *
 * VisitTime API lets you access reports by Hour (Server time), and by Hour
 * Local Time of your visitors.
 */
class VisitTime extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'VisitTime' );
    }

    /**
     * Get the visit by local time
     *
     * @param string $segment
     */
    public function getVisitPerLocalTime( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getVisitInformationPerLocalTime' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }

    /**
     * Get the visit by server time
     *
     * @param string $segment
     * @param boolean $hideFutureHoursWhenToday Hide the future hours when the report is created for today
     */
    public function getVisitPerServerTime( $idSite, $period, $date, $segment = '', $hideFutureHoursWhenToday = '' )
    {
        $this->setQuery( 'getVisitInformationPerServerTime' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
            'hideFutureHoursWhenToday' => $hideFutureHoursWhenToday
        ));

        return $this->execute();
    }

    /**
     * Get the visit by server time
     *
     * @param string $segment
     */
    public function getByDayOfWeek( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getByDayOfWeek' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }
}