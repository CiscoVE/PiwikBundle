<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: SEO
 * Get SEO information
 */
class SearchEngineOptimization extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'SEO' );
    }

    /**
     * Get the SEO rank of an url
     *
     * @param string $url
     */
    public function getSeoRank( $url )
    {
        $this->setQuery( 'getRank' );
        $this->setParameters( array(
            'url' => $url,
        ));

        return $this->execute();
    }
}