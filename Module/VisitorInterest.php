<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: VISITOR INTEREST
 * Get the interests of the visitor
 */
class VisitorInterest extends Base
{
    const MODULE_NAME                       = 'VisitorInterest';
    const NUMBEROFVISITSPERVISITDURATION    = 'getNumberOfVisitsPerVisitDuration';
    const NUMBEROFVISITSPERPAGE             = 'getNumberOfVisitsPerPage';
    const NUMEROFVISITSPERDAYSINCELAST      = 'getNumberOfVisitsByDaysSinceLast';
    const NUMBEROFVISITSBYVISITCOUNT        = 'getNumberOfVisitsByVisitCount';

    public function __construct( $request )
    {
        parent::__construct( $request, self::MODULE_NAME );
    }

    public function getData( $query, $params )
    {
        if( null !== $query )
        {
            return $this->request( $this->name . $query, $params );
        }
        else
        {
            return false;
        }
    }
}