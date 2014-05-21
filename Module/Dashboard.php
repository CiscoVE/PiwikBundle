<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: Dashboard
 *
 * @see http://developer.piwik.org/api-reference/reporting-api
 *
 * This API is the Dashboard API: it gives information about dashboards.
 */
class Dashboard extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'Dashboard' );
    }

    public function get()
    {
        $this->setQuery( 'getDashboards' );

        return $this->execute();
    }
}