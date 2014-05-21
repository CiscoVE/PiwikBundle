<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: VISIT FREQUENCY
 *
 * VisitFrequency API lets you access a list of metrics related to Returning
 * Visitors.
 */
class VisitFrequency extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'VisitFrequency' );
    }

    /**
     * Get the visit frequency
     *
     * @param string $segment
     * @param string $columns
     */
    public function getVisitFrequency( $idSite, $period, $date, $segment = '', $columns = '' )
    {
        $this->setQuery( 'get' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
            'columns'   => $columns,
        ));

        return $this->execute();
    }
}