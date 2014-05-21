<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: Provider
 *
 * The Provider API lets you access reports for your visitors Internet Providers.
 */
class Provider extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'Provider' );
    }

    public function getProvider( $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getProvided' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }
}