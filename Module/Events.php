<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\Module as Base;

/**
 * MODULE: Events
 *
 * Custom Events API
 */
class Events extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'Events' );
    }

	public function getCategory( $idSite, $period, $date, $segment = '', $expanded = '' , $secondaryDimension = '' )
    {
        $this->setQuery( 'getCategory' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'segment'               => $segment,
            'expanded'              => $expanded,
            'secondaryDimension'    => $secondaryDimension,
        ));

        return $this->execute();
    }

	public function getAction( $idSite, $period, $date, $segment = '', $expanded = '' , $secondaryDimension = '' )
    {
        $this->setQuery( 'getAction' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'segment'               => $segment,
            'expanded'              => $expanded,
            'secondaryDimension'    => $secondaryDimension,
        ));

        return $this->execute();
    }

	public function getName( $idSite, $period, $date, $segment = '', $expanded = '' , $secondaryDimension = '' )
    {
        $this->setQuery( 'getName' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'segment'               => $segment,
            'expanded'              => $expanded,
            'secondaryDimension'    => $secondaryDimension,
        ));

        return $this->execute();
    }

	public function getActionFromCategoryId( $idSite, $period, $date, $idSubtable, $segment = '')
    {
        $this->setQuery( 'getActionFromCategoryId' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'idSubtable'            => $idSubtable,
            'segment'               => $segment,
        ));

        return $this->execute();
    }

	public function getNameFromCategoryId( $idSite, $period, $date, $idSubtable, $segment = '')
    {
        $this->setQuery( 'getNameFromCategoryId' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'idSubtable'            => $idSubtable,
            'segment'               => $segment,
        ));

        return $this->execute();
    }

	public function getCategoryFromActionId( $idSite, $period, $date, $idSubtable, $segment = '')
    {
        $this->setQuery( 'getCategoryFromActionId' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'idSubtable'            => $idSubtable,
            'segment'               => $segment,
        ));

        return $this->execute();
    }

	public function getNameFromActionId ( $idSite, $period, $date, $idSubtable, $segment = '')
    {
        $this->setQuery( 'getNameFromActionId' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'idSubtable'            => $idSubtable,
            'segment'               => $segment,
        ));

        return $this->execute();
    }

	public function getActionFromNameId ( $idSite, $period, $date, $idSubtable, $segment = '')
    {
        $this->setQuery( 'getActionFromNameId' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'idSubtable'            => $idSubtable,
            'segment'               => $segment,
        ));

        return $this->execute();
    }

	public function getCategoryFromNameId ( $idSite, $period, $date, $idSubtable, $segment = '')
    {
        $this->setQuery( 'getCategoryFromNameId' );
        $this->setParameters( array(
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'idSubtable'            => $idSubtable,
            'segment'               => $segment,
        ));

        return $this->execute();
    }
}