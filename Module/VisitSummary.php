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
    const MODULE_NAME           = 'VisitsSummary';
    const VISITSSUMMARY         = 'get';
    const VISITS                = 'getVisits';
    const UNIQUEVISITORS        = 'getUniqueVisitors';
    const ACTIONS               = 'getActions';
    const MAXACTIONS            = 'getMaxActions';
    const BOUNCECOUNT           = 'getBounceCount';
    const VISITSCONVERTED       = 'getVisitsConverted';
    const SUMVISITSLENGTH       = 'getSumVisitsLength';
    const SUMVISITSLENGTHPRETTY = 'getSumVisitsLengthPretty';

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