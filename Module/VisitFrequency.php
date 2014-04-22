<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: VISIT FREQUENCY
 * Get visit frequency
 */
class VisitFrequency extends Base
{
    const MODULE_NAME   = 'VisitFrequency';
    const GET           = 'get';

    public function __construct( Request $request )
    {
        parent::__construct( $request, self::MODULE_NAME );
    }

    protected function getData( $query, $params = array() )
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