<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: VISIT FREQUENCY
 * Get visit frequency
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
    public function getVisitFrequency( $segment = '', $columns = '' )
    {
        $this->setQuery( 'get' );
        $this->setParameters( array(
            'segment' => $segment,
            'columns' => $columns,
        ));

        return $this->execute();
    }
}