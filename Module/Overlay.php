<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: Overlay
 */
class Overlay extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'Overlay' );
    }

    public function getTranslations( $idSite )
    {
        $this->setQuery( 'getTranslations' );
        $this->setParameter( 'idSite', $idSite );

        return $this->execute();
    }

    public function getExcludedQueryParameters( $idSite )
    {
        $this->setQuery( 'getExcludedQueryParameters' );
        $this->setParameter( 'idSite', $idSite );

        return $this->execute();
    }

    public function getFollowingPages( $url, $idSite, $period, $date, $segment = '' )
    {
        $this->setQuery( 'getFollowingPages' );
        $this->setParameters( array(
            'url'       => $url,
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
        ));

        return $this->execute();
    }
}