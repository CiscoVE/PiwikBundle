<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: Annotations
 *
 * API for annotations plugin. Provides methods to create, modify, delete &
 * query annotations.
 */
class Annotations extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'Annotations' );
    }

    public function add( $idSite, $date, $note, $starred = '0' )
    {
        $this->setQuery( 'add' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'date'      => $date,
            'note'      => $note,
            'starred'   => $starred,
        ));

        return $this->execute();
    }

    public function save( $idSite, $idNote, $date = '', $note = '', $starred = '' )
    {
        $this->setQuery( 'save' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'idNote'    => $idNote,
            'date'      => $date,
            'note'      => $note,
            'starred'   => $starred,
        ));

        return $this->execute();
    }

    public function delete( $idSite, $idNote )
    {
        $this->setQuery( 'delete' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'idNote'    => $idNote,
        ));

        return $this->execute();
    }

    public function deleteAll( $idSite )
    {
        $this->setQuery( 'deleteAll' );
        $this->setParameter( 'idSite', $idSite );

        return $this->execute();
    }

    public function get( $idSite, $idNote )
    {
        $this->setQuery( 'get' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'idNote'    => $idNote,
        ));

        return $this->execute();
    }

    public function getAll( $idSite, $date = '', $period = 'day', $lastN = '' )
    {
        $this->setQuery( 'getAll' );
        $this->setParameters( array(
            'idSite'    => $idSite,
            'date'      => $date,
            'period'    => $period,
            'lastN'     => $lastN,
        ));

        return $this->execute();
    }

    public function getAnnotationCountForDates( $idSite, $date, $period, $lastN = '', $annotationText = '' )
    {
        $this->setQuery( 'getAnnotationCountForDates' );
        $this->setParameters( array(
            'idSite'            => $idSite,
            'date'              => $date,
            'period'            => $period,
            'lastN'             => $lastN,
            'getAnnotationText' => $annotationText,
        ));
    }
}