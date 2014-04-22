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
    const MODULE_NAME           = 'VisitTime';
    const VISITLOCALTIME        = 'getVisitInformationPerLocalTime';
    const VISITSERVERTIME       = 'getVisitInformationPerServerTime';
    const VISITBYDAYOFWEEK      = 'getByDayOfWeek';

    public function __construct( Request $request )
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