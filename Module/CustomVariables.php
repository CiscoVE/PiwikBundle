<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: CUSTOM VARIABLES
 *
 * @see http://piwik.org/docs/custom-variables/
 *
 * The Custom Variables API lets you access reports for your Custom Variables
 * names and values.
 */
class CustomVariables extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'CustomAlerts' );
    }

    /**
     * Get custom variables
     *
     * @param string $segment
     * @param string $expanded
     */
    public function getCustomVariables( $idSite, $period, $date, $segment = '', $expanded = '' )
    {
        $this->setQuery( 'getCustomVariables' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'period'    => $period,
            'date'      => $date,
            'segment'   => $segment,
            'expanded'  => $expanded,
        ));

        return $this->execute();
    }

    /**
     * Get information about a custom variable
     *
     * @param int $idSubtable
     * @param string $segment
     */
    public function getCustomVariablesValuesFromNameId( $idSite, $period, $date, $idSubtable, $segment = '' )
    {
        $this->setQuery( 'getCustomVariablesValuesFromNameId' );
        $this->setParameters( array(
            'idSite'        => $idSite,
            'period'        => $period,
            'date'          => $date,
            'idSubtable'    => $idSubtable,
            'segment'       => $segment,
        ));

        return $this->execute();
    }
}