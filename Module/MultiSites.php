<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: MultiSites
 *
 * The MultiSites API lets you request the key metrics (visits, page views,
 * revenue) for all Websites in Piwik.
 */
class MultiSites extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'MultiSites' );
    }

    /**
     * Get information about multiple sites
     *
     * @param string $segment
     * @param string $enhanced
     */
    public function getMultiSites( $period, $date, $segment = '', $enhanced = '', $pattern = '' )
    {
        $this->setQuery( 'getAll' );
        $this->setParameters( array(
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
            'enhanced'  => $enhanced,
            'pattern'   => $pattern,
        ));

        return $this->execute();
    }

    /**
     * Get key metrics about one of the sites the user manages
     *
     * @param string $segment
     * @param string $enhanced
     */
    public function getOne( $idSite, $period, $date, $segment = '', $enhanced = '' )
    {
        $this->setQuery( 'getOne' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
            'enhanced'  => $enhanced,
        ));

        return $this->execute();
    }
}