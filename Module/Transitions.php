<?php

namespace CiscoSystems\PiwikBundle\Module;

use CiscoSystems\PiwikBundle\Connection\Request;
use CiscoSystems\PiwikBundle\Module\AbstractModule as Base;

/**
 * MODULE: TRANSITIONS
 *
 * Get transitions for page URLs, titles and actions
 */
class Transitions extends Base
{
    public function __construct( Request $request )
    {
        parent::__construct( $request, 'Transitions' );
    }

    /**
     * Get transitions for a page title
     *
     * @param $pageTitle
     * @param string $segment
     * @param string $limitBeforeGrouping
     * @return mixed
     */
    public function getTransitionsForPageTitle( $pageTitle, $idSite, $period, $date, $segment = '', $limitBeforeGrouping = '' )
    {
        $this->setQuery( 'getTransitionsForPageTitle' );
        $this->setParameters( array(
            'pageTitle'             => $pageTitle,
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'segment'               => $segment,
            'limitBeforeGrouping'   => $limitBeforeGrouping,
        ));

        return $this->execute();
    }

    /**
     * Get transitions for a page URL
     *
     * @param $pageUrl
     * @param string $segment
     * @param string $limitBeforeGrouping
     * @return mixed
     */
    public function getTransitionsForPageUrl( $pageUrl, $idSite, $period, $date, $segment = '', $limitBeforeGrouping = '' )
    {
        $this->setQuery( 'getTransitionsForPageTitle' );
        $this->setParameters( array(
            'pageUrl'               => $pageUrl,
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'segment'               => $segment,
            'limitBeforeGrouping'   => $limitBeforeGrouping,
        ));

        return $this->execute();
    }

    /**
     * Get transitions for a page URL
     *
     * @param $actionName
     * @param $actionType
     * @param string $segment
     * @param string $limitBeforeGrouping
     * @param string $parts
     * @param bool $returnNormalizedUrls
     * @return mixed
     */
    public function getTransitionsForAction( $actionName, $actionType, $idSite, $period, $date, $segment = '', $limitBeforeGrouping = '', $parts = 'all' )
    {
        $this->setQuery( 'getTransitionsForAction' );
        $this->setParameters( array(
            'actionName'            => $actionName,
            'actionType'            => $actionType,
            'idSite'                => $idSite,
            'period'                => $period,
            'date'                  => $date,
            'segment'               => $segment,
            'limitBeforeGrouping'   => $limitBeforeGrouping,
            'parts'                 => $parts,
        ));

        return $this->execute();
    }

    /**
     * Get translations for the transitions
     *
     * @return mixed
     */
    public function getTransitionsTranslations()
    {
        $this->setQuery( 'getTranslations' );

        return $this->execute();
    }
}